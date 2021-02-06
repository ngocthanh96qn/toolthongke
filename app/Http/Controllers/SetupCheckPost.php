<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CheckPost;
class SetupCheckPost extends Controller
{
    public function index(){
    	$data = [];
    	$data = CheckPost::all()->toArray();
    	// dd($data);
    	return view('pages.setup_page_chekPost',compact('data'));
    	
    }
    public function store(Request $request)
    {
      $data = $request->except('_token');
      CheckPost::create($data);
      return redirect()->route('menu.SetupCheckPost');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ConfigInfo  $configInfo
     * @return \Illuminate\Http\Response
     */
    public function show(ConfigInfo $configInfo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ConfigInfo  $configInfo
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {

       $data = ['name'=>$request->name, 'page'=>$request->page];
		CheckPost::where('id','=',$request->userid)->update($data);
      return redirect()->route('menu.SetupCheckPost');
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ConfigInfo  $configInfo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ConfigInfo $configInfo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ConfigInfo  $configInfo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        CheckPost::where('id','=',$request->id)->delete();
           return redirect()->route('menu.SetupCheckPost');
    }
}
