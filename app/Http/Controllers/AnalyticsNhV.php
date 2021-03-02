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
use App\CheckDay;
use Auth;

class AnalyticsNhV extends Controller
{
     public function index($id=null)
    {
        if ($id==null) {
           $pages = ConfigPage::where('user_id','=',Auth::user()->id)->get()->toArray(); 
           $nameUser = Auth::user()->name;
           $id = Auth::user()->id;
        }
        else {
            $pages = ConfigPage::where('user_id','=',$id)->get()->toArray();
            if($pages==null){ return false;}
            $nameUser = User::find($id)->name;
           
        }
	
	$month = $this->getDayOfMonth();
    $view = $this->viewDay($pages,$month);
    $view_beforeMonth = $this->viewBeforeMonth($pages);
    //loc du lieu
    $view_yesterday=0;
    $view_BeforeYesterday=0;
    $view_thisMonth=0;
    $index = 0;
    // dd($view['viewPage']);
    foreach ($view['viewPage'] as $name => $page) {
    	$view_yesterday = $view_yesterday + $page[1]['view'];
    	$view_BeforeYesterday = $view_BeforeYesterday + $page[2]['view'];
    	$view_page_yesterday[$name]['view_yesterday']=$page[1]['view'];
        $view_page_yesterday[$name]['view_BeforeYesterday']=$page[2]['view'];
    	$view_page_thisMonth[$name]['view_thisMonth']=0;
    	foreach ($page as $key => $day) {
    		$view_thisMonth = $view_thisMonth + $day['view'];
    		$view_page_thisMonth[$name]['view_thisMonth'] += $day['view'];
    		$bieu_do[$index][0][]=$day['day'];
    		$bieu_do[$index][1][]=$day['view'];
    		$bieu_do[$index][3]=$name;
    	}
       
    $index++;

    }
    foreach ($view['viewTotal'] as $day => $view) {
       $viewDay['day'][] = $day;
       $viewDay['data'][] = $view;
    } 

    $data['view_yesterday'] =$view_yesterday;
    $data['view_BeforeYesterday'] =$view_BeforeYesterday;
    $data['view_thisMonth'] =$view_thisMonth;
    $data['view_page_yesterday'] =$view_page_yesterday;
    $data['view_page_thisMonth'] =$view_page_thisMonth;
    $data['bieu_do'] =$bieu_do;
    $data['view_beforeMonth'] =$view_beforeMonth;
    $data['name'] = $nameUser;
    $data['viewDay'] = $viewDay;
    $data['id'] = $id;
    $data['bieu_do_post'] = $this->dataCheckPost($id);
    // dd($data);
        return view('pages.pageNv',['data'=>$data]);
    }

    public function dataCheckPost($id){
       $pages =  ConfigPage::where('user_id','=',$id)->get()->toArray();

       $dataPage = [];
       foreach ($pages as $key => $page) {
            $slPost = CheckDay::where('page_id','=',$page['id'])->get()->toArray();
            $dataPage[] = $slPost;
       }
       // dd($dataPage);

       $bieudo = [];
       foreach ($dataPage as $key => $DayAndSl) {
            foreach ($DayAndSl as $key1 => $value) {
                $bieudo[$key][0][] =  $value['day'];
                $bieudo[$key][1][] =  $value['sl'];
                $bieudo[$key][3] =  ConfigPage::find($value['page_id'])->name_page;
                $bieudo[$key][4] =  ConfigPage::find($value['page_id'])->username;
            }           
       }

    return $bieudo;
    }

    public function viewDay($pages,$month){
        foreach ($month as $key11 => $days) {
            $total[$days] = 0;
        }
    foreach ($pages as $key => $page) {
    	Analytics::setViewId($page['view_id']);
	    foreach ($month as $key => $days) {
		    $day = Carbon::create($days);

		    $startDate = $day;
		    $endDate = $day;
			$day = Period::create($startDate, $endDate);
		    $response = Analytics::performQuery($day,'ga:sessions',['dimensions'=>'ga:source,ga:medium','filters'=>'ga:medium=='.$page['utm_medium']]);
		    $view['viewPage'][$page['name_page']][$key]['day'] = $days;
            $view['viewPage'][$page['name_page']][$key]['view'] = 0;
            
		    if ($response->rows !== null) {
		    	foreach ($response->rows as $abc => $value) {
		    		if ( $value[0] == $page['utm_source']) {
		    			$view['viewPage'][$page['name_page']][$key]['view'] = $value[2];
                        $total[$days] = $total[$days]+$value[2] ;
		    		}  		    		
		    	}
		    } else {$view['viewPage'][$page['name_page']][$key]['view'] = 0;}
	    }
    }   
    $view['viewTotal'] = $total;
    return $view;
    }

    public function getDayOfWeek(){
    	$dayOfTheWeek = Carbon::today()->dayOfWeek;
    	switch ($dayOfTheWeek) {
    		case '0':
    			for ($i=0; $i < 7 ; $i++) { 
                    $date = new DateTime($i.'days ago');
                    $date = $date->format('Y-m-d');
                    $week[] = $date;
                }
                return $week;
    			break;
    		
    		default:
    			for ($i=0; $i < $dayOfTheWeek ; $i++) { 
                    $date = new DateTime($i.'days ago');
                    $date = $date->format('Y-m-d');
                    $week[] = $date;
                }
                return $week;
    			break;
    	}
                
     }

     public function getDayOfMonth(){
     	$dayOfMonth = Carbon::today()->day;
        if ($dayOfMonth<7) {
            $dayOfMonth = 7;
        }
    			for ($i=0; $i < $dayOfMonth ; $i++) { 
                    $date = new DateTime($i.'days ago');
                    $date = $date->format('d-m-Y');
                    $week[] = $date;
                }
                return $week;            
     }

      public function viewBeforeMonth($pages){
    
    	foreach ($pages as $key => $page) {
    	Analytics::setViewId($page['view_id']);
    	$endMonth = Carbon::today()->subDay(Carbon::now()->day);
    	$month = $endMonth->month;
    	$year = $endMonth->year;
    	$firstMonth = "1-".$month."-".$year;
    	$firstMonth = Carbon::create($firstMonth); 
    	$days = Period::create($firstMonth, $endMonth);
		    $response = Analytics::performQuery($days,'ga:sessions',['dimensions'=>'ga:source,ga:medium','filters'=>'ga:medium=='.$page['utm_medium']]);
            $view_page[$page['name_page']]['viewBeforeMonth'] =0;
		    if ($response->rows !== null) {
		    	foreach ($response->rows as $abc => $value) {
		    		if ( $value[0] == $page['utm_source']) {
		    			$view_page[$page['name_page']]['viewBeforeMonth'] = $value[2];
		    		}		    		
		    	}
		    } else {$view_page[$page['name_page']]['viewBeforeMonth'] = 0;}
	    
    }
    return $view_page;

    }

    public function setDay(Request $Request){
    $pages = ConfigPage::where('user_id','=',$Request->id)->get()->toArray();
    $nameUser = User::find($Request->id)->name;
    $dt1 = Carbon::create($Request->startDay);
    $dt2 = Carbon::create($Request->endDay);
    $interval = $dt1->diff($dt2);
    $customer=[];
    for ($i=0; $i <= $interval->days ; $i++) {
                $dt2 = Carbon::create($Request->endDay);
                $date = $dt2->subDays($i); 
                $date = $date->format('d-m-Y');
                $customer[] = $date;
     }
    $view = $this->viewDay($pages,$customer);
    // dd($view);
    $view_beforeMonth = $this->viewBeforeMonth($pages);
    //loc du lieu
    $view_yesterday=0;
    $view_BeforeYesterday=0;
    $view_thisMonth=0;
    $index = 0;
    foreach ($view['viewPage'] as $name => $page) {
        if (isset($page[2])) {
           $view_BeforeYesterday = $view_BeforeYesterday + $page[2]['view'];
           $view_page_yesterday[$name]['view_BeforeYesterday']=$page[2]['view'];
        }
        else {
           $view_page_yesterday[$name]['view_BeforeYesterday']=0;
        }
        if (isset($page[1])) {
             $view_yesterday = $view_yesterday + $page[1]['view'];   
             $view_page_yesterday[$name]['view_yesterday']=$page[1]['view'];
        } else {   
            $view_page_yesterday[$name]['view_yesterday']= 0;
        }
       
        $view_page_thisMonth[$name]['view_thisMonth']=0;
        foreach ($page as $key => $day) {
            $view_thisMonth = $view_thisMonth + $day['view'];
            $view_page_thisMonth[$name]['view_thisMonth'] += $day['view'];
            $bieu_do[$index][0][]=$day['day'];
            $bieu_do[$index][1][]=$day['view'];
            $bieu_do[$index][3]=$name;
        }
       
    $index++;

    }
    foreach ($view['viewTotal'] as $day => $view) {
       $viewDay['day'][] = $day;
       $viewDay['data'][] = $view;
    }

    $data['view_yesterday'] = $view_yesterday;
    $data['view_BeforeYesterday'] = $view_BeforeYesterday;
    $data['view_thisMonth'] = $view_thisMonth;
    $data['view_page_yesterday'] = $view_page_yesterday;
    $data['view_page_thisMonth'] = $view_page_thisMonth;
    $data['bieu_do'] = $bieu_do;
    $data['view_beforeMonth'] = $view_beforeMonth;
    $data['name'] = $nameUser;
    $data['viewDay'] = $viewDay;
    $data['id'] = $Request->id;
    // dd($data);
    return view('pages.pageNv',['data'=>$data]);
          
    }

    public function runSchedule(){
        $users = User::all()->toArray();
         
        foreach ($users as $key11 => $user) {
            
           $viewSh = $this->index($user['id']);
        }
        
    }
}
