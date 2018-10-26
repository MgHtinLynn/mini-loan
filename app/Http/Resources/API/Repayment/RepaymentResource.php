<?php

namespace App\Http\Resources\API\Repayment;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property mixed id
 * @property mixed loan_id
 * @property mixed duration_end_date
 * @property mixed repayment_amount
 * @property mixed repayment_frequency
 * @property mixed repayment_received
 * @property mixed repayment_full_paid
 * @property mixed paternity_leave_amount
 */
class RepaymentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'loan_id' => $this->loan_id,
            'duration_end_date' => $this->duration_end_date,
            'repayment_amount' => $this->repayment_amount,
            'repayment_frequency' => $this->repayment_frequency,
            'repayment_received' => $this->repayment_received,
            'repayment_full_paid' => $this->repayment_full_paid,
            'paternity_leave_amount' => $this->paternity_leave_amount,
        ];
    }
}
