<?php

namespace App\Http\Controllers\API\LoanType;

use App\Http\Controllers\Controller;
use App\Http\Resources\API\LoanType\LoanTypeCollection;
use App\Models\LoanType;

class LoanTypeController extends Controller
{
    /**
     * @return LoanTypeCollection
     */
    public function index()
    {
        $loanTypeList = LoanType::all();
        return new LoanTypeCollection($loanTypeList);
    }
}
