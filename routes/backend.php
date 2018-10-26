<?php
/**
 * Created by PhpStorm.
 * User: htinlynn
 * Date: 10/26/18
 * Time: 10:45 AM
 */

/*
|--------------------------------------------------------------------------
| Backend Routes
|--------------------------------------------------------------------------
|
| Here is where you can register Backend routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your Backend Admin Panel!
|
*/

Route::patch('loanVerify/{loan_id}', 'Loan\LoanController@loanVerify');