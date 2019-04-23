<?php

use Illuminate\Http\Request;


//Route::apiResource('/lp','LPController');
Route::apiResource('/user','UserController');
Route::apiResource('/car','CarController');
Route::apiResource('/log','LogController');
Route::apiResource('/permissions','UserPermissionController');
Route::apiResource('/carpermissions','CarPermissionController');
Route::apiResource('/photo','PhotoController');
Route::apiResource('/whitelist','WhitelistController');
