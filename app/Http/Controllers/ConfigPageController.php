<?php

namespace App\Http\Controllers;

use App\ConfigPage;
use App\ConfigInfo;
use App\PageTeamAb;
use Illuminate\Http\Request;
use App\User;
use App\Http\Requests\PageRequest;
class ConfigPageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $teamIAs = ConfigInfo::where('team_nv','=','Team_IA')->get()->toArray();
        $teamABs = ConfigInfo::where('team_nv','=','Team_AB')->get()->toArray();
        // dd($teamIAs);
        $info_userAB=[];
         foreach ($teamIAs as $key => $teamIA) {
            // $info = User::find($$teamIA['user_id'])->configInfos->toArray(); 
            // dd($teamIA);
            $page = ConfigPage::where('user_id','=',$teamIA['user_id'])->get();
            // dd($page);
            if($page != null ) {
                $page = $page->toArray();
            }
            else{
                $page = [];
                
            }
            // dd(User::find($teamIA['user_id'])->name);
            $info_userIA[] = ['user_id'=>$teamIA['user_id'], 'name'=>User::find($teamIA['user_id'])->name, 'name_page'=>$page];           
        }
        $info_userAB=[];
        foreach ($teamABs as $key => $teamAB) {
            $page = PageTeamAb::where('user_id','=',$teamAB['user_id'])->get();
            // dd($page);
            if($page != null ) {
                $page = $page->toArray();
            }
            else{
                $page = [];
                
            }
            // dd(User::find($teamIA['user_id'])->name);

            $info_userAB[] = ['user_id'=>$teamAB['user_id'], 'name'=>User::find($teamAB['user_id'])->name, 'name_page'=>$page];           
        }
    // dd($info_userAB);
        return view('pages.setup_page',['info_userIA'=>$info_userIA,'info_userAB'=>$info_userAB]);
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PageRequest $request)
    {
        $data = $request->except('_token');
        ConfigPage::create($data);
        return redirect()->route('menu.setup_page');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ConfigPage  $configPage
     * @return \Illuminate\Http\Response
     */
    public function show(ConfigPage $configPage)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ConfigPage  $configPage
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
       $data_page = ['name_page'=>$request->name_page,'view_id'=>$request->view_id,'utm_source'=>$request->utm_source, 'utm_medium'=>$request->utm_medium, 'username'=>$request->username];
       $info = ConfigPage::where('id','=',$request->pageid)->update($data_page);
       return redirect()->route('menu.setup_page');
       
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ConfigPage  $configPage
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ConfigPage $configPage)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ConfigPage  $configPage
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $page = ConfigPage::find($request->id);
        $page->delete();
        return redirect()->route('menu.setup_page');
    }
}
