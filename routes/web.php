<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('epochToDate/{epoch}', function ($epoch) {
    return \Carbon\Carbon::createFromTimeStampUTC($epoch / 1000)->toDateString();
});

Route::get('dateToEpoch/{date}', function ($date) {
    return \Carbon\Carbon::parse($date)->timestamp * 1000;
});

Route::get('test-month',function (){
   $date = \Carbon\Carbon::now();
   dd($date->addMonth(2));
});