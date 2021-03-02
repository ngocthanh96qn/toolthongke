<?php

namespace App\Http\Controllers;

use App\PageTeamAb;
use Illuminate\Http\Request;

class PageTeamAbController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        // dd($request->toArray());
        $data = $request->except('_token');
        PageTeamAb::create($data);
        return redirect()->route('menu.setup_page');                                                     
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\PageTeamAb  $pageTeamAb
     * @return \Illuminate\Http\Response
     */
    public function show(PageTeamAb $pageTeamAb)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PageTeamAb  $pageTeamAb
     * @return \Illuminate\Http\Response
     */
    public function edit(PageTeamAb $pageTeamAb)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PageTeamAb  $pageTeamAb
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PageTeamAb $pageTeamAb)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PageTeamAb  $pageTeamAb
     * @return \Illuminate\Http\Response
     */
    public function destroy(PageTeamAb $pageTeamAb)
    {
        //
    }
}
