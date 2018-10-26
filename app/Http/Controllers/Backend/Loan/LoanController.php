<?php

namespace App\Http\Controllers\Backend\Loan;

use App\Helpers\httpStatus;
use App\Http\Repositories\Loan\LoanRepository;
use App\Http\Repositories\Repayment\RepaymentRepository;
use App\Http\Resources\API\Loan\LoanResource;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LoanController extends Controller
{
    use httpStatus;
    /**
     * @var LoanRepository
     */
    private $loanRepository;
    /**
     * @var RepaymentRepository
     */
    private $repaymentRepository;

    /**
     * LoanController constructor.
     * @param LoanRepository $loanRepository
     * @param RepaymentRepository $repaymentRepository
     */
    public function __construct(LoanRepository $loanRepository, RepaymentRepository $repaymentRepository)
    {
        $this->loanRepository = $loanRepository;
        $this->repaymentRepository = $repaymentRepository;
    }

    /**
     * @param Request $request
     * @param $id
     * @return LoanResource|\Illuminate\Http\JsonResponse
     */
    public function loanVerify(Request $request, $id)
    {
        if ($request->method() === 'PATCH') {
            $loanInfo = $this->loanRepository->loanVerify($id);
            if ($loanInfo) {
                $this->repaymentRepository->createRepayment($loanInfo);
                $loanData = $this->loanRepository->getLoanWithRepayment($id);
                $loanData->message = config('general.loan_verify_message');
                return new LoanResource($loanData);
            }
            return $this->invalidVerifyLoan();
        }
        return $this->methodNotAllow();

    }
}
