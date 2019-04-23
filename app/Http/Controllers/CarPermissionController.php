<?php

namespace App\Http\Controllers;

use App\CarPermission;
use Illuminate\Http\Request;

class CarPermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return CarPermission::all();
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
        $perm=new CarPermission;
        $perm->l_p=$request->l_p;
        $perm->is_allowed=$request->is_allowed;
        $perm->save();
        return $perm;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\CarPermission  $carPermission
     * @return \Illuminate\Http\Response
     */
    public function show($carPermission)
    {
        //
        return CarPermission::where("l_p",$carPermission)->get();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\CarPermission  $carPermission
     * @return \Illuminate\Http\Response
     */
    public function edit(CarPermission $carPermission)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\CarPermission  $carPermission
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $carPermission)
    {
        $carPermission2=CarPermission::where("l_p",$carPermission);
        $carPermission2->update($request->all());
        return $carPermission2->get();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\CarPermission  $carPermission
     * @return \Illuminate\Http\Response
     */
    public function destroy($carPermission)
    {
        //
        CarPermission::where("l_p",$carPermission)->delete();
    }
}
