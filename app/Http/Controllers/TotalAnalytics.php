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
    	$month = $this->getDayOfMonth();
    	$viewDay = $this->viewDay($month);
    	$yesterday=$this->viewYesterday();
    	$thisMonth=$this->viewThisMonth();
    	$beforeMonth=$this->viewBeforeMonth();
    	$statisNv = $this->statisNv();
    	$statisPage = $this->statisPage();
    	$data=['yesterday'=>$yesterday,'thisMonth'=>$thisMonth,'beforeMonth'=>$beforeMonth,'viewDay'=>$viewDay,'statisNv'=>$statisNv,'statisPage'=>$statisPage];
    	return view('pages.analytics_total',['data'=>$data]);
    }
    public function statisNv(){
    	$users = User::where('check','=','checked')->get();
    	foreach ($users as $key => $user) {
    		$info = User::find($user->id)->configPages->toArray();    
    		foreach ($info as $key => $value) {
    			$data_nv[$user->name][$key]['viewId']=$value['view_id'];
    			$data_nv[$user->name][$key]['source']=$value['utm_source'];
    			$data_nv[$user->name] = array_unique($data_nv[$user->name],0);
    		}
    	}
    	foreach ($data_nv as $nv_name => $nv) { //[nv=>viewid và source]
    		$view_nv_week[$nv_name]=0;
    		$view_nv_month[$nv_name]=0;
    		foreach ($nv as $key => $info) { //[viewid va source]
    			$view = $this->statisNvYesterday($info);
    			if (isset($view[0][0])) {
    				$view_nv_week[$nv_name] = $view_nv_week[$nv_name] + $view[0][0];
    			}
    			$view = $this->statisNvMonth($info);
    			if (isset($view[0][0])) {
    				$view_nv_month[$nv_name] = $view_nv_month[$nv_name] + $view[0][0];
    			}   	   				
    		}
    	}
    	foreach ($view_nv_week as $name_w => $view_w) {
    		$name1[]=$name_w;
    		$view1[]=$view_w;
    	}
    	foreach ($view_nv_month as $name => $view) {
    		$name2[]=$name;
    		$view2[]=$view;
    	}
    	$statisNv_week[]=$name1;
    	$statisNv_week[]=$view1;
    	$statisNv_Month[]=$name2;
    	$statisNv_Month[]=$view2;
    	$statisNv[0]=$statisNv_week;
    	$statisNv[1]=$statisNv_Month;
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
/////////////////////////////////
    public function statisPage(){
    	$pages = ConfigPage::where('check','=','checked')->get();
    	foreach ($pages as $key => $page) {	  
    			$data_page[$page->name_page]['viewId']=$page->view_id;
    			$data_page[$page->name_page]['medium']=$page->utm_medium;   		
    	}
    	foreach ($data_page as $page_name => $info) { //[nv=>viewid và source]
    		
    			$view = $this->statisPageYesterday($info);
    			if (isset($view[0][0])) {
    				$view_page_week[$page_name] = $view[0][0];
    			}
    			$view = $this->statisPageMonth($info);
    			if (isset($view[0][0])) {
    				$view_page_month[$page_name] =  $view[0][0];
    			}   	   				
    		
    	}
 
    	foreach ($view_page_week as $name_w => $view_w) {
    		$name3[]=$name_w;
    		$view3[]=$view_w;
    	}
    	foreach ($view_page_month as $name => $view) {
    		$name4[]=$name;
    		$view4[]=$view;
    	}
    	$statisPage_week[]=$name3;
    	$statisPage_week[]=$view3;
    	$statisPage_Month[]=$name4;
    	$statisPage_Month[]=$view4;
    	$statisPage[0]=$statisPage_week;
    	$statisPage[1]=$statisPage_Month;
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
    	// dd($users);		
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
    	return $response->rows[0][0];
    }
    public function viewBeforeMonth(){
    	
    	$endMonth = Carbon::today()->subDay(Carbon::now()->day);
    	$month = $endMonth->month;
    	$year = $endMonth->year;
    	$firstMonth = "1-".$month."-".$year;
    	$firstMonth = Carbon::create($firstMonth); 
    	$day = Period::create($firstMonth, $endMonth);
    	$response = Analytics::performQuery($day,'ga:sessions');
    	return $response->rows[0][0];
    }
    public function viewDay($month){
    	
    	foreach ($month as $key => $dayi) {
    		$day1 = Carbon::create($dayi); 
    		$day2 = Carbon::create($dayi); 
    		$day = Period::create($day1, $day2);
    		$response = Analytics::performQuery($day,'ga:sessions');
    		$data_month['day'][] =$dayi;
    		$data_month['data'][] =$response->rows[0][0]; 		 	
    	}
    	$data_month['day'] = array_reverse($data_month['day']);
    	$data_month['data'] = array_reverse($data_month['data']);
    	return $data_month;
    	
    }
    public function getDayOfMonth(){
     	$dayOfMonth = Carbon::today()->day;
    			for ($i=0; $i < $dayOfMonth ; $i++) { 
                    $date = new DateTime($i.'days ago');
                    $date = $date->format('Y-m-d');
                    $week[] = $date;
                }
                return $week;            
     }
}
