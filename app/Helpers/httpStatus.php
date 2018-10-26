<?php
/**
 * Created by PhpStorm.
 * User: htinlynn
 * Date: 10/25/18
 * Time: 5:28 PM
 */

namespace App\Helpers;


use Illuminate\Http\JsonResponse;

trait httpStatus
{
    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function userExistResponse()
    {
        return response()->json([
            'status' => 422,
            'message' => 'User Already Exist',
        ], 422);
    }

    public function tokenInvalidResponse()
    {
        return response()->json([
            'status' => 422,
            'message' => 'Token Invalid',
        ], 422);
    }

    /**
     * @param $message
     * @return JsonResponse
     */
    public function unauthenticatedResponse($message)
    {
        return response()->json(['status' => 401, 'message' => $message], 401);
    }

    /**
     * @return JsonResponse
     */
    public function invalidVerifyResponse()
    {
        return response()->json([
            'status' => 422,
            'message' => 'User Need to Verify with OTP (Token)',
        ], 422);
    }

    /**
     * @return JsonResponse
     */
    public function invalidVerifyLoan()
    {
        return response()->json([
            'status' => 422,
            'message' => 'Loan Already Verify',
        ], 422);
    }

    /**
     * @return JsonResponse
     */
    public function methodNotAllow()
    {
        $data = [
            'status' => 405,
            'message' => 'Method Not Allow'
        ];
        return response()->json($data, 405);
    }

    /**
     *
     */
    public function repaymentInValidResponse()
    {
        return response()->json([
            'status' => 422,
            'message' => 'Repayment Already Full Paid',
        ], 422);
    }
}

