<?php

namespace App\Http\Resources\API\Loan;

use App\Http\Resources\API\LoanType\LoanTypeResource;
use App\Http\Resources\API\Repayment\RepaymentResource;
use App\Http\Resources\API\User\UserResource;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property mixed message
 * @property mixed id
 * @property mixed loan_amount
 * @property mixed loan_offer_date
 * @property mixed loan_verify_date
 * @property mixed repayment_frequency
 * @property mixed duration_start_date
 * @property mixed duration_end_date
 * @property mixed interest_rate
 * @property mixed arrangement_fees
 * @property mixed total_amount
 * @property mixed verify
 * @property mixed full_paid
 */
class LoanResource extends JsonResource
{

    /**
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function with($request)
    {
        return [
            'status' => $this->status ?? 200,
            'message' => $this->message
        ];
    }

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'loan_amount' => $this->loan_amount,
            'duration' => $this->loan_offer_date,
            'loan_verify_date' => $this->loan_verify_date,
            'repayment_frequency' => $this->repayment_frequency,
            'duration_start_date' => $this->duration_start_date,
            'duration_end_date' => $this->duration_end_date,
            'interest_rate' => $this->interest_rate,
            'arrangement_fees' => $this->arrangement_fees,
            'total_amount' => $this->total_amount,
            'verify' => $this->verify,
            'full_paid' => $this->full_paid,
            'user' => new UserResource($this->whenLoaded('user')),
            'loan_type' => new LoanTypeResource($this->whenLoaded('loanType')),
            'repayments' => RepaymentResource::collection($this->whenLoaded('repayments'))
        ];
    }
}
