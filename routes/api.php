<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get("user", "User@index");
Route::get("user/{user}", "User@show");
Route::post("user", "User@store");
Route::put("user/{user}", "User@update");
Route::delete("user/{user}", "User@destroy");

