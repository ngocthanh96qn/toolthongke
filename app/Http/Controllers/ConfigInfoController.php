<?php

namespace App\Http\Controllers;

use App\ConfigInfo;
use App\ConfigPage;
use App\User;
use App\RoleUser;
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
            $role =  RoleUser::where('user_id','=',$user['id'])->get()->toArray();
            if ($role[0]['role_id']==1) {
                $role ='Admin';
                   }
            else {
                $role ='Nhân Viên';
            }       
            $info_user[] = ['user_id'=>$user['id'], 'name'=>$user['name'], 'mail_nv'=>$user['email'], 'phone_nv'=>$info['phone_nv'], 'team_nv'=>$info['team_nv'],'role'=> $role];           
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
      $data_user = ['user_id'=>$user->id, 'phone_nv'=>$request->phone_nv, 'team_nv'=>$request->team_nv];
      ConfigInfo::create($data_user);
      $data_role = ['user_id'=>$user->id, 'role_id'=>$request->roles];
      RoleUser::create($data_role);
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
       $data_info = ['phone_nv'=>$request->phone_nv, 'team_nv'=>$request->team_nv];
       $info = ConfigInfo::where('user_id','=',$request->userid)->update($data_info);
       return redirect()->route('menu.setup_info');
    }

public function editPass(Request $request)
    {
       // dd($request->toArray());
       $user = User::find($request->userid);
       $data_user = ['password'=>\Hash::make($request->pass_new)];
       $user->update($data_user);
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
        // dd($request->toArray());
        $info = User::find($request->id)->configInfos;
        $info->delete();
        $user = User::find($request->id);
        $user->delete();
        ConfigPage::where('user_id','=',$request->id)->delete();
        return redirect()->route('menu.setup_info');
    }
}
