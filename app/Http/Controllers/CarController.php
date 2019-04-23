<?php

namespace App\Http\Controllers;

use App\Car;
use App\Http\Resources\Resource\CaResource;
use App\Http\Resources\Resource\UserResource;
use Illuminate\Http\Request;

class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return Car::all();
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
        $res= new Car;
        $res->user_id = $request->user_id;
        $res->licence_plate = $request->licence_plate;
        $res->color = $request->color;
        $res->model = $request->model;
        $res->save();
        return redirect("/user/".$res->user_id);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Car  $car
     * @return \Illuminate\Http\Response
     */
    public function show($car)
    {
        //
        return Car::where('licence_plate',$car)->get();
    }

    public function carinfo($car)
    {


        $car=Car::where('licence_plate',$car)->get();
//        return $car;
        $owner=\App\user::find($car[0]["user_id"]);

        return view("car", compact('car'))->with("owner",$owner);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Car  $car
     * @return \Illuminate\Http\Response
     */
    public function edit(Car $car)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Car  $car
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Car $car)
    {
        $car->update($request->all());
        return new CaResource(Car::find($car['id']));
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Car  $car
     * @return \Illuminate\Http\Response
     */
    public function destroy(Car $car)
    {
        //
        $car->delete();
    }
}
