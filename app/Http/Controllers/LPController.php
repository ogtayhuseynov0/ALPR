<?php

namespace App\Http\Controllers;

use App\Model\LP;
use Illuminate\Http\Request;

class LPController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
		return LP::all();
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\LP  $lP
     * @return \Illuminate\Http\Response
     */
    public function show($lP)
    {
        //
			return LP::where('lplate',$lP)->get();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\LP  $lP
     * @return \Illuminate\Http\Response
     */
    public function edit(LP $lP)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\LP  $lP
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, LP $lP)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\LP  $lP
     * @return \Illuminate\Http\Response
     */
    public function destroy(LP $lP)
    {
        //
    }
}
