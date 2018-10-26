<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('test-api', function () {
    return response()->json([
        'status' => 200,
        'message' => 'Success',
        'data' => 'JSON Array'
    ]);
});

Route::get('loanTypes', 'LoanType\LoanTypeController@index');

Route::group(['middleware' => 'auth:api'], function () {
    //can be use resource route
    Route::post('loan', 'Loan\LoanController@create');

    Route::patch('repayment/{repayment_id}', 'Repayment\RepaymentController@update');

});


