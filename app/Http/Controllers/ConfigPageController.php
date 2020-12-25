<?php

namespace App\Http\Controllers;

use App\ConfigPage;
use Illuminate\Http\Request;
use App\User;
class ConfigPageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $users = User::all()->toArray();
         foreach ($users as $key => $user) {
            $info = User::find($user['id'])->configInfos->toArray(); 
            $page = User::find($user['id'])->configPages;
            if($page != null ) {
                $page = $page->toArray();
            }
            else{
                $page = [];
                
            }
            
            $info_user[] = ['user_id'=>$user['id'], 'name'=>$user['name'], 'name_page'=>$page];           
        }
    // dd($info_user);
        return view('pages.setup_page',['info_user'=>$info_user]);
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
    public function store(Request $request)
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
       $data_page = ['name_page'=>$request->name_page,'view_id'=>$request->view_id,'utm_source'=>$request->utm_source, 'utm_medium'=>$request->utm_medium];
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
