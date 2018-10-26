<?php
/**
 * Created by PhpStorm.
 * User: htinlynn
 * Date: 10/26/18
 * Time: 11:00 AM
 */

namespace App\Http\Repositories\Repayment;


use App\Http\Repositories\BaseRepository;
use App\Models\Repayment;
use Carbon\Carbon;

class RepaymentRepository extends BaseRepository
{

    /**
     * LoanRepository constructor
     * @param Repayment $repayment
     */
    public function __construct(Repayment $repayment)
    {
        parent::__construct($repayment);
    }

    /**
     * @param $loanInfo
     */
    public function createRepayment($loanInfo)
    {
        for ($x = 1; $x <= $loanInfo->repayment_frequency; $x++) {
            $durationEndDate = Carbon::now()->addMonth($x)->toDateString();
            $repaymentAmount = $loanInfo->total_amount / $loanInfo->repayment_frequency;
            parent::create(['loan_id' => $loanInfo->id, 'duration_end_date' => $durationEndDate, 'repayment_amount' => $repaymentAmount]);
        }
    }

    /**
     * @param $amount
     * @param $id
     * @return mixed|null
     */
    public function monthlyRepayment($amount, $id)
    {
        $repayment = parent::find($id);
        //if depend on business flow , if loan user should only repayment process
        // code
        // check repayment have full paid
        if (!$repayment->repayment_full_paid) {
            $repayment->repayment_received = $repayment->repayment_received + $amount;
            if ($repayment->repayment_received >= $repayment->repayment_amount) {
                $repayment->repayment_full_paid = 1;
            }
            //if repayment received over current date
            if (now()->toDateString() > $repayment->duration_end_date) {
                // pay paternity leave amount
                // if follow business flow, implement code for paternity fees
                $repayment->paternity_leave_amount = $repayment->repayment_amount * config('general.paternity_value');
            }

            $repayment->increment('repayment_frequency');
            $repayment->save();
            return $repayment;
        }
        return null;
    }
}

