<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Analytics;
use Spatie\Analytics\Period;
use Carbon\Carbon;
use DateTime;
use App\ConfigPage;
use App\ConfigInfo;
use App\User;
use Auth;
use DB;

class TotalAnalytics extends Controller
{
    public function index(){
                
        $statisNv = $this->statisNv(); //view nhân viên hôm qua tháng này tháng trước

        $statisPage = $this->statisPage(); //view page hôm qua tháng này
        // dd($statisPage);
    	$month = $this->getDayOfMonth(); //lấy ngày trong tháng
        // dd($month);
    	$viewDay = $this->viewDay($month); //ngày và view từng ngày của tháng
        // dd($viewDay); 
    	$totalViewId = $this->totalViewId(); //view từng view ID view tháng này, view tháng trước
        //code sắp xếp rankNv
        foreach ($statisNv as $key => $value) {
            $rankNv[$key] = $value['view_nv_month'];
        }
        arsort($rankNv);
        foreach ($statisNv as $key => $value) {
            $rankNvYesterday[$key] = $value['view_nv_yesterday'];
        }
        arsort($rankNvYesterday);
        ///
        //code sắp xếp rankPage
        foreach ($statisPage as $key => $value) {
            $rankPage[$key] = $value['thisMonth'];
        }
        arsort($rankPage);
        foreach ($statisPage as $key => $value) {
            $rankPageYesterday[$key] = $value['yesterday'];
        }
        arsort($rankPageYesterday);
        ///
    	$data=['statisNv'=>$statisNv,'statisPage'=>$statisPage,'viewDay'=>$viewDay,'viewDay'=>$viewDay,'totalViewId'=>$totalViewId,'rankNv'=>$rankNv,'rankPage'=>$rankPage,'rankNvYesterday'=>$rankNvYesterday,'rankPageYesterday'=>$rankPageYesterday];
        // dd($data);
    	return view('pages.pageTotal',['data'=>$data]);
    }
    /////////////////////////////////
    public function statisNv(){
    	$users = User::where('check','=','checked')->get();

    	foreach ($users as $key => $user) {
            // dd($user->id);
    		$info = User::find($user->id)->configPages->toArray();    
    		foreach ($info as $key => $value) {
    			$data_nv[$user->name][$key]['viewId']=$value['view_id'];
    			$data_nv[$user->name][$key]['source']=$value['utm_source'];
                $data_nv[$user->name][$key]['id']=$user->id;
    			$data_nv[$user->name] = array_unique($data_nv[$user->name],0);
    		}
            
    	}
        // dd($data_nv);
    	foreach ($data_nv as $nv_name => $nv) { //[nv=>viewid và source]
    		$statisNv[$nv_name]['view_nv_yesterday']=0;
    		$statisNv[$nv_name]['view_nv_month']=0;
            $statisNv[$nv_name]['view_nv_beforeMonth']=0;
    		foreach ($nv as $key => $info) { //[viewid va source]
    			$view = $this->statisNvYesterday($info);
    			if (isset($view[0][0])) {
    				$statisNv[$nv_name]['view_nv_yesterday'] = $statisNv[$nv_name]['view_nv_yesterday'] + $view[0][0];
    			}
    			$view = $this->statisNvMonth($info);
    			if (isset($view[0][0])) {
    				$statisNv[$nv_name]['view_nv_month'] = $statisNv[$nv_name]['view_nv_month'] + $view[0][0];
    			}   
                $view = $this->statisNvBeforeMonth($info);
                if (isset($view[0][0])) {
                    $statisNv[$nv_name]['view_nv_beforeMonth'] = $statisNv[$nv_name]['view_nv_beforeMonth'] + $view[0][0];
                } 
                $statisNv[$nv_name]['id']=	$info['id'];  				
    		}
    	}
    	return $statisNv;
    }

    public function statisNvYesterday($info){
    	Analytics::setViewId($info['viewId']);
    	$startDate = Carbon::yesterday();
    	$endDate = Carbon::yesterday();
    	$a = Period::create($startDate, $endDate);
    	$response = Analytics::performQuery($a,'ga:sessions',['filters'=>'ga:source=='.$info['source']]);//tong view
    	return $response->rows;
    }

    public function statisNvMonth($info){
    	Analytics::setViewId($info['viewId']);
    	$firstMonth = Carbon::today()->subDay(Carbon::now()->day-1);
    	$today = Carbon::today();
    	$day = Period::create($firstMonth, $today);
    	$response = Analytics::performQuery($day,'ga:sessions',['filters'=>'ga:source=='.$info['source']]);//tong view
    	return $response->rows;
    }
     public function statisNvBeforeMonth($info){
        Analytics::setViewId($info['viewId']);
        $endMonth = Carbon::today()->subDay(Carbon::now()->day);
        $month = $endMonth->month;
        $year = $endMonth->year;
        $firstMonth = "1-".$month."-".$year;
        $firstMonth = Carbon::create($firstMonth); 
        $day = Period::create($firstMonth, $endMonth);
        $response = Analytics::performQuery($day,'ga:sessions',['filters'=>'ga:source=='.$info['source']]);//tong view

        return $response->rows;
    }
///////////////////////////////// Thống kê page
    public function statisPage(){
    	$pages = ConfigPage::where('check','=','checked')->get();
        // dd($pages);
    	foreach ($pages as $key => $page) {	  
    			$data_page[$page->name_page]['viewId']=$page->view_id;
    			$data_page[$page->name_page]['medium']=$page->utm_medium;   		
                $data_page[$page->name_page]['source']=$page->utm_source;           
    	}

    	foreach ($data_page as $page_name => $info) { //[nv=>viewid và source]
    		
    			$view = $this->statisPageYesterday($info);
    			if (isset($view[0][0])) {
                    $statisPage[$page_name]['yesterday'] = $view[0][0];
    				// $view_page_week[$page_name] = $view[0][0];   
    			}
                else {
                    $statisPage[$page_name]['yesterday'] = 0;
                }
    			$view = $this->statisPageMonth($info);
    			if (isset($view[0][0])) {
                    $statisPage[$page_name]['thisMonth'] = $view[0][0];
    				// $view_page_month[$page_name] =  $view[0][0];
    			}   	   				
    		$statisPage[$page_name]['source'] = $info['source'];
    	}
    	return $statisPage;
    }

     public function statisPageYesterday($info){
    	Analytics::setViewId($info['viewId']);
    	$startDate = Carbon::yesterday();
    	$endDate = Carbon::yesterday();
    	$a = Period::create($startDate, $endDate);
    	$response = Analytics::performQuery($a,'ga:sessions',['filters'=>'ga:medium=='.$info['medium']]);//tong view
    	return $response->rows;
    }
    public function statisPageMonth($info){
    	Analytics::setViewId($info['viewId']);
    	$firstMonth = Carbon::today()->subDay(Carbon::now()->day-1);
    	$today = Carbon::today();
    	$day = Period::create($firstMonth, $today);
    	$response = Analytics::performQuery($day,'ga:sessions',['filters'=>'ga:medium=='.$info['medium']]);//tong view
    	return $response->rows;
    }
/////////////////////////////////
    public function setupTotal(){
    	$users = User::all()->toArray();
    	$pages = ConfigPage::all()->toArray();
        
    	return view('pages.setup_total',['users'=>$users,'pages'=>$pages]);
    }
    public function setupUser(Request $Request){
      		User::where('check','=','checked')->update(['check'=>null]);
      		if (isset($Request->users)) {
      			foreach ($Request->users as $key => $id) {
	    		User::where('id','=',$id)->update(['check'=>'checked']);
	    		}
      		}
    	return redirect()->route('setup_total');		 	
    }
    public function setupPage(Request $Request){
    		ConfigPage::where('check','=','checked')->update(['check'=>null]);
    		if (isset($Request->pages)) {
    			foreach ($Request->pages as $key => $id) {
	    		ConfigPage::where('id','=',$id)->update(['check'=>'checked']);
	    		}
    		}
    	return redirect()->route('setup_total');		
    }
////////////////
    public function totalViewId(){ //co view hom qua, thang nay, thang trước
                $view_id = DB::table('config_pages')->select('view_id')->get()->toArray();
        foreach ($view_id as $key => $value) {
           $viewID[] = $value->view_id;
        }
        $viewID = array_unique($viewID,0);
        foreach ($viewID as $key => $view_id) {
           Analytics::setViewId($view_id);
            // $totalViewId[$view_id]['viewYesterday'] =  $this->viewYesterday();
            $totalViewId[$view_id]['viewThisMonth'] =  $this->viewThisMonth();

            $totalViewId[$view_id]['viewBeforeMonth'] =  $this->viewBeforeMonth();
       }
      return $totalViewId;
    }

    public function viewYesterday(){
    $startDate = Carbon::yesterday();
    $endDate = Carbon::yesterday();
    $a = Period::create($startDate, $endDate);
    $response = Analytics::performQuery($a,'ga:sessions');
    	return $response->rows[0][0];
    }
    public function viewThisMonth(){
    	
    	$firstMonth = Carbon::today()->subDay(Carbon::now()->day-1);
    	$today = Carbon::today();
    	$day = Period::create($firstMonth, $today);
    	$response = Analytics::performQuery($day,'ga:sessions');
    	if ($response->rows==null) {
            $view = 0;
        }
        else {
            $view = $response->rows[0][0];
        }
        return  $view;
    }
    public function viewBeforeMonth(){
    	
    	$endMonth = Carbon::today()->subDay(Carbon::now()->day);
    	$month = $endMonth->month;
    	$year = $endMonth->year;
    	$firstMonth = "1-".$month."-".$year;
    	$firstMonth = Carbon::create($firstMonth); 
    	$day = Period::create($firstMonth, $endMonth);
    	$response = Analytics::performQuery($day,'ga:sessions');
        if ($response->rows==null) {
            $view = 0;
        }
        else {
            $view = $response->rows[0][0];
        }
    	return  $view;
    }
    public function viewDay($month){
        $view_id = DB::table('config_pages')->select('view_id')->get()->toArray();
        foreach ($view_id as $key => $value) {
           $viewID[] = $value->view_id;
        }
        $viewID1 = array_unique($viewID,0);
        $viewID = [];
        foreach ($viewID1 as $key => $value) {
           $viewID[] = $value;
        }
        foreach ($viewID as $keyid => $view_id) {
           Analytics::setViewId($view_id);
            foreach ($month as $key => $dayi) {
                $days = Carbon::create($dayi);   
                $startDate = $days;
                $endDate = $days;
                $day = Period::create($startDate, $endDate);
                $response = Analytics::performQuery($day,'ga:sessions');
                $data_month[$keyid]['day'][] =$days->format('d-m-Y');
                if (isset($response->rows[0][0])) {
                    $data_month[$keyid]['data'][] =$response->rows[0][0];
                } else {
                     $data_month[$keyid]['data'][] =0;
                }
                            
            }
            $data_month[$keyid]['day'] = array_reverse($data_month[$keyid]['day']);
            $data_month[$keyid]['data'] = array_reverse($data_month[$keyid]['data']);
            $data_month[$keyid]['view_id'] =$view_id;
        } 
    
    	return $data_month;
    	
    }
    public function getDayOfMonth(){
     	$dayOfMonth = Carbon::today()->day;
        if ( $dayOfMonth < 7) {
           $dayOfMonth = 7;
        }
        
    			for ($i=0; $i < $dayOfMonth ; $i++) { 
                    $date = new DateTime($i.'days ago');
                    $date = $date->format('Y-m-d');
                    $week[] = $date;
                }
                return $week;            
     }

    public function setDay(Request $Request){
        $dt1 = Carbon::create($Request->startDay);
        $dt2 = Carbon::create($Request->endDay);
        $interval = $dt1->diff($dt2);
        // $date = $dt2->subDays(30);
        // $date = $date->format('Y-m-d');
        // dd($date);
        $customer=[];
        for ($i=0; $i <= $interval->days ; $i++) {
                    $dt2 = Carbon::create($Request->endDay);
                    $date = $dt2->subDays($i); 
                    $date = $date->format('Y-m-d');
                    $customer[] = $date;
         }

        $statisNv = $this->statisNv(); //view nhân viên hôm qua tháng này tháng trước
        $statisPage = $this->statisPage(); //view page hôm qua tháng này
        $viewDay = $this->viewDay($customer); //ngày và view từng ngày của tháng
        $totalViewId = $this->totalViewId(); //view từng view ID view tháng này, view tháng trước
        //code sắp xếp rankNv
        foreach ($statisNv as $key => $value) {
            $rankNv[$key] = $value['view_nv_month'];
        }
        arsort($rankNv);
        foreach ($statisNv as $key => $value) {
            $rankNvYesterday[$key] = $value['view_nv_yesterday'];
        }
        arsort($rankNvYesterday);
        ///
        //code sắp xếp rankPage
        foreach ($statisPage as $key => $value) {
            $rankPage[$key] = $value['thisMonth'];
        }
        arsort($rankPage);
        foreach ($statisPage as $key => $value) {
            $rankPageYesterday[$key] = $value['yesterday'];
        }
        arsort($rankPageYesterday);
        ///
        $data=['statisNv'=>$statisNv,'statisPage'=>$statisPage,'viewDay'=>$viewDay,'viewDay'=>$viewDay,'totalViewId'=>$totalViewId,'rankNv'=>$rankNv,'rankPage'=>$rankPage,'rankNvYesterday'=>$rankNvYesterday,'rankPageYesterday'=>$rankPageYesterday];
        // dd($data);
        return view('pages.pageTotal',['data'=>$data]);   
    }

}
