<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Userdetails;

Route::get('/', function () {
    return view('welcome');
});

Route::get('userview',[Userdetails::class,'index']);
Route::get('userview/{id}',[Userdetails::class,'selecteduser']);
Route::post('register',[Userdetails::class,'Register']);
Route::post('login',[Userdetails::class,'Login']);
Route::get('userview/{id}/edit',[Userdetails::class,'Edit']);
Route::put('userview/{id}/update',[Userdetails::class,'Update']);
Route::delete('userview/{id}/delete',[Userdetails::class,'Delete']);
Route::get('logout', [Userdetails::class,'Logout']);

