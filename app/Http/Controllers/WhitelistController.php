<?php

namespace App\Http\Controllers;

use App\Whitelist;
use Illuminate\Http\Request;

class WhitelistController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Whitelist::all();
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
        $whitelist = new Whitelist;
        $whitelist->licence_plate=$request->licence_plate;
        $whitelist->to=$request->to;
        $whitelist->from=$request->from;
        $whitelist->save();

        return $whitelist;

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Whitelist  $whitelist
     * @return \Illuminate\Http\Response
     */
    public function show(Whitelist $whitelist)
    {
        return $whitelist;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Whitelist  $whitelist
     * @return \Illuminate\Http\Response
     */
    public function edit(Whitelist $whitelist)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Whitelist  $whitelist
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Whitelist $whitelist)
    {
        $whitelist->update($request->all());
        return Whitelist::find($whitelist['id']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Whitelist  $whitelist
     * @return \Illuminate\Http\Response
     */
    public function destroy(Whitelist $whitelist)
    {
        $whitelist->delete();
    }
}
