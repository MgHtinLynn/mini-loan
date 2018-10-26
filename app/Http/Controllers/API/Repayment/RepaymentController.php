<?php

namespace App\Http\Controllers\API\Repayment;

use App\Helpers\httpStatus;
use App\Http\Repositories\Repayment\RepaymentRepository;
use App\Http\Repositories\Transaction\TransactionRepository;
use App\Http\Requests\Repayment\RepaymentPatchRequest;
use App\Http\Controllers\Controller;
use App\Http\Resources\API\Repayment\RepaymentResource;

class RepaymentController extends Controller
{
    use httpStatus;
    /**
     * @var repaymentRepository
     */
    private $repaymentRepository;
    /**
     * @var TransactionRepository
     */
    private $transactionRepository;

    /**
     * LoanController constructor.
     * @param RepaymentRepository $repaymentRepository
     * @param TransactionRepository $transactionRepository
     */
    public function __construct(RepaymentRepository $repaymentRepository, TransactionRepository $transactionRepository)
    {
        $this->repaymentRepository = $repaymentRepository;
        $this->transactionRepository = $transactionRepository;
    }

    /**
     * @param RepaymentPatchRequest $request
     * @param $id
     * @return RepaymentResource|\Illuminate\Http\JsonResponse
     */
    public function update(RepaymentPatchRequest $request, $id)
    {
        if ($request->method() === 'PATCH') {
            $repaymentInfo = $this->repaymentRepository->monthlyRepayment($request->input('amount'), $id);
            if ($repaymentInfo) {
                //create transaction for repayment process
                $this->transactionRepository->createTransaction($id);
                return (new RepaymentResource($repaymentInfo))->additional([
                    'status' => 200,
                    'message' => 'successfully repayment process'
                ]);
            }
            return $this->repaymentInValidResponse();

        }
        return $this->methodNotAllow();
    }
}

