<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Analytics;
use Spatie\Analytics\Period;
use Carbon\Carbon;
use DateTime;
use App\ConfigPage;
use App\ConfigInfo;
use Auth;

class AnalyticsNv extends Controller
{
     public function index()
    {
	

	$month = $this->getDayOfMonth();

    $info_nv = ConfigPage::where('user_id','=', Auth::user()->id)->get()->toArray();

    $view_id = $info_nv[0]['view_id']; 
    $utm_source = $info_nv[0]['utm_source']; 

    $pages = ConfigPage::where('user_id','=',Auth::user()->id)->get()->toArray();
    // dd($page);
    foreach ($month as $key => $day) {
    	$day = Carbon::create($day);
    	$data[$key]['day'] = $day->format('Y-m-d');
      
        foreach ($pages as $index => $page) {
            $data_analytics = $this->viewDay($page['view_id'],$page['utm_source'],$day); //doc du lieu page theo viewid
            $data_page[$index]['name'] = $page['name_page'];
            $data_page[$index]['data'][$key][0] = $day->format('Y-m-d');
            $data_page[$index]['data'][$key][1] = 0;//set trc gia trị view 
           foreach ($data_analytics as $key_ana => $data_analytic) {
               if ($data_analytic['page']== $page['utm_medium']) {
                   $data_page[$index]['data'][$key][1] = $data_analytic['view'] ;    
               }      
           } 
           
        }
    }

    foreach ($data_page as $key => $page) {
        $view_month=0;
        foreach ($page['data'] as $index => $view) {
           $view_month = $view_month + $view[1];
        }
        $data_page[$key]['view_month']=$view_month;
    }
// dd($data_page);
    foreach ($data as $key => $day) {
        $view_day =0;
        foreach ($data_page as $index => $page) {
            foreach ($page['data'] as $ss => $viewss) {

                if( $viewss[0] == $day['day']){$view = $viewss[1];} 
         
            }
         
            $view_day = $view_day + $view;
        }
        $data[$key]['view'] = $view_day;
    }

    foreach ($data as $key => $data_day) {
    
    	$data_x[]=$data_day['day'];
    	$data_y[]=$data_day['view'];
    }
    // dd($data);
    $data_total_x = array_reverse($data_x);
    $data_total_y = array_reverse($data_y);
	$data_total_x = json_encode($data_total_x);
	$data_total_y = json_encode($data_total_y);
	$data_total['x']= $data_total_x;
	$data_total['y']= $data_total_y;
    ///
    // dd($data_page);
        return view('pages.pageNv',['data_total'=>$data_total, 'data_page'=>$data_page]);
    }

    public function viewDay($view_id,$utm_source,$day){
       
    Analytics::setViewId($view_id);
    $startDate = $day;
    $endDate = $day;
	$day = Period::create($startDate, $endDate);
    $response = Analytics::performQuery($day,'ga:sessions',['dimensions'=>'ga:source,ga:medium','filters'=>'ga:source=='.$utm_source]);

    $data = collect($response['rows'] ?? [])->map(function (array $data) {
            return [
                'id_nv' => $data[0],
                'page' => $data[1],
                'view' => (int) $data[2],
            ];
        });
    return $data->toArray();
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
    			for ($i=0; $i < $dayOfMonth ; $i++) { 
                    $date = new DateTime($i.'days ago');
                    $date = $date->format('Y-m-d');
                    $week[] = $date;
                }
                return $week;            
     }
}
