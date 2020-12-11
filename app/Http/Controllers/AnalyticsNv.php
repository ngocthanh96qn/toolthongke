<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Analytics;
use Spatie\Analytics\Period;
use Carbon\Carbon;
use DateTime;
class AnalyticsNv extends Controller
{
     public function index()
    {
		
	$month = $this->getDayOfMonth();
    $id_nv = 'q3010';
    foreach ($month as $key => $day) {
    	$day = Carbon::create($day);
    	$data[$key]['data'] = $this->viewDay($id_nv,$day);
    	$data[$key]['day'] = $day->format('Y-m-d');;
    }
    
    foreach ($data as $key => $data_day) {
    	 $view = 0;
    	foreach ($data_day['data'] as $key1 => $page) {
    		if(isset($page['view'])){
    			$view = $view + $page['view'];
    		}	
    	}
    	$data[$key]['total'] = $view;
    	$data_x[]=$data_day['day'];
    	$data_y[]=$view;
    }
    $data_total_x = array_reverse($data_x);
    $data_total_y = array_reverse($data_y);
	$data_total_x = json_encode($data_total_x);
	$data_total_y = json_encode($data_total_y);
	$data_total['x']= $data_total_x;
	$data_total['y']= $data_total_y;
        return view('pages.analytics_nv',['data_total'=>$data_total]);
    }

    public function viewDay($id_nv,$day){
    $startDate = $day;
    $endDate = $day;
	$day = Period::create($startDate, $endDate);
    $response = Analytics::performQuery($day,'ga:sessions',['dimensions'=>'ga:source,ga:medium','filters'=>'ga:source=='.$id_nv]);

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
