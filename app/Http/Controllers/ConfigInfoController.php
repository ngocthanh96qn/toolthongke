<?php

namespace App\Http\Controllers;

use App\ConfigInfo;
use App\User;
use Illuminate\Http\Request;
use App\Http\Requests\InfoRequest;

class ConfigInfoController extends Controller
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
            $info_user[] = ['user_id'=>$user['id'],'id_nv'=>$info['id_nv'], 'name'=>$user['name'], 'mail_nv'=>$user['email'], 'phone_nv'=>$info['phone_nv'], 'team_nv'=>$info['team_nv']];           
        }
        return view('pages.setup_info',['info_user'=>$info_user]);
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
    public function store(InfoRequest $request)
    {
      $data_user = ['name'=>$request->name_nv, 'email'=>$request->gmail_nv, 'password'=>\Hash::make($request->password)];
      $user = User::create($data_user);
      $data_user = ['user_id'=>$user->id, 'id_nv'=>$request->id_nv, 'phone_nv'=>$request->phone_nv, 'team_nv'=>$request->team_nv];
      ConfigInfo::create($data_user);
      return redirect()->route('menu.setup_info');
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
       
       $user = User::find($request->userid);
       $data_user = ['name'=>$request->name_nv, 'email'=>$request->gmail_nv];
       $user->update($data_user);
       $data_info = ['id_nv'=>$request->id_nv, 'phone_nv'=>$request->phone_nv, 'team_nv'=>$request->team_nv];
       $info = ConfigInfo::where('user_id','=',$request->userid)->update($data_info);
       return redirect()->route('menu.setup_info');
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
        $info = User::find($request->id)->configInfos;
        $info->delete();
        $user = User::find($request->id);
        $user->delete();
        return redirect()->route('menu.setup_info');
    }
}
