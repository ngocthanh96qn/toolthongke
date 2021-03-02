<?php

namespace App\Http\Controllers;

use App\TrafficPageTeamAb;
use App\PageTeamAb;
use App\ConfigInfo;
use App\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use DateTime;
class TrafficPageTeamAbController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         //danh sach nhan vien team Ab
        $teamAb = ConfigInfo::where('team_nv','=','Team_AB')->get();
        $dsTeamAb=[];
        foreach ($teamAb as $key => $info) {

           $dsTeamAb[] = User::where('id','=',$info->user_id)->get()->toArray();
          
        }
        // dd($dsTeamAb);
        //danh sach page của từng nhân viên
         $dsPageNv=[];
        foreach ($dsTeamAb as $key => $nvAb) {
            $pages = PageTeamAb::where('user_id','=',$nvAb[0]['id'])->get()->toArray();
            $dsPageNv[$key]['name'] = $nvAb[0]['name'];
            if ($pages!==null) {
               foreach ($pages as $key1 => $page) {
               $dsPageNv[$key]['page'][$key1]['page_name'] = $page['page_name'];
               $dsPageNv[$key]['page'][$key1]['user_name'] = $page['user_name'];
               $traffic = TrafficPageTeamAb::where('page_id', $page['id'])->get()->toArray();
               $dsPageNv[$key]['page'][$key1]['total']=0;
               foreach ($traffic as $key2 => $value) {
                 $dsPageNv[$key]['page'][$key1]['day'][] = $value['day'];
                 $dsPageNv[$key]['page'][$key1]['traffic'][] = $value['traffic'];
                 $dsPageNv[$key]['page'][$key1]['total'] = $dsPageNv[$key]['page'][$key1]['total'] + $value['traffic'];
               }
                }
            }
            
        }

        dd($dsPageNv);
        //view theo từng pape
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }
    public function inputData()
    {
        $pages = PageTeamAb::all()->toArray();
        $days = [];
         for ($i=0; $i <= 7 ; $i++) {
                $dt2 = Carbon::today();
                $date = $dt2->subDays($i); 
                $date = $date->format('d-m-Y');
                $days[] = $date;
     }
        $days = array_reverse($days);
        // dd($pages);
        return view('pages.page_input_data',['pages'=>$pages,'days'=>$days]);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        dd($request->toArray());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\TrafficPageTeamAb  $trafficPageTeamAb
     * @return \Illuminate\Http\Response
     */
    public function show(TrafficPageTeamAb $trafficPageTeamAb)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\TrafficPageTeamAb  $trafficPageTeamAb
     * @return \Illuminate\Http\Response
     */
    public function edit(TrafficPageTeamAb $trafficPageTeamAb)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\TrafficPageTeamAb  $trafficPageTeamAb
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TrafficPageTeamAb $trafficPageTeamAb)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\TrafficPageTeamAb  $trafficPageTeamAb
     * @return \Illuminate\Http\Response
     */
    public function destroy(TrafficPageTeamAb $trafficPageTeamAb)
    {
        //
    }
}
