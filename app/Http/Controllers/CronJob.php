<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CheckPost;
use App\CheckDay;
include_once ('./simple_html_dom.php');

class CronJob extends Controller
{
    public function runScheduleTotal(){
        $Pages = CheckPost::all()->toArray();
        $data=[];
        foreach ($Pages as $key => $page) {
          $data = $this->StaticsPost($page['page']);
          CheckDay::updateOrCreate(['page_id' => $page['id'], 'day' => $data[0]],['sl' => $data[1]]);
        }
         
    }

        public function StaticsPost($usernamePage){
    $url = "https://www.facebook.com/".$usernamePage."/posts/?ref=page_internal";

    $opts = array(
      'http'=>array(
        'header'=>"User-Agent:Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/54.0.2840.99 Safari/537.36\r\n"
      )
    );

    $context = stream_context_create($opts);
    $html = file_get_html($url , false, $context);
    foreach($html->find('abbr') as $e)
    {
        // echo $e->outertext . '<br>';
        $time[] = $this->GetBetween($e->outertext, 'data-utime="','"');
    }
    for ($i=0; $i < count($time)-1 ; $i++) { 
       if($time[$i] < $time[$i+1]) { $a = $i; break; } else { $a = 0;}
    }
    for ($j=0; $j <= $a; $j++) { 
        unset($time[$j]);
    }
    foreach ($time as $key => $value) {
        $dates[] = date('d/m/Y', $value);
    }
    $Sl=0;
    foreach ($dates as $key => $date) {

        if ($date==$dates[0]) {
            $Sl++; 
        }
         
    }
    $today[0] = $dates[0];
    $today[1] = $Sl;
    return $today;
}
public  function GetBetween($content,$start,$end){
        $r = explode($start, $content);
        if (isset($r[1])){
            $r = explode($end, $r[1]);
            return $r[0];
        }
        return 'false' ;
    }
}
