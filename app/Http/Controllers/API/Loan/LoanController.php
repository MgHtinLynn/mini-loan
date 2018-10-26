<?php

namespace App\Http\Controllers\API\Loan;

use App\Http\Repositories\Loan\LoanRepository;
use App\Http\Requests\Loan\LoanRequest;
use App\Http\Controllers\Controller;
use App\Http\Resources\API\Loan\LoanResource;

class LoanController extends Controller
{
    /**
     * @var LoanRepository
     */
    private $loanRepository;

    /**
     * LoanController constructor.
     * @param LoanRepository $loanRepository
     */
    public function __construct(LoanRepository $loanRepository)
    {
        $this->loanRepository = $loanRepository;
    }

    /**
     * @param LoanRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function create(LoanRequest $request)
    {
        $loanInfo = $this->loanRepository->createLoan($request->only(['loan_amount', 'duration', 'repayment_frequency', 'interest_rate', 'arrangement_fees', 'loan_type_id']));
        $loanInfo->status = 201;
        $loanInfo->message = 'Successfully Loan Created';
        return (new LoanResource($loanInfo))->response()->setStatusCode(201);
    }
}
