<?php
/**
 * Created by PhpStorm.
 * User: htinlynn
 * Date: 10/26/18
 * Time: 2:55 AM
 */

namespace App\Http\Repositories\Loan;


use App\Helpers\epoch;
use App\Http\Repositories\BaseRepository;
use App\Models\Loan;
use Carbon\Carbon;

class LoanRepository extends BaseRepository
{
    use epoch;

    /**
     * LoanRepository constructor
     * @param Loan $loan
     */
    public function __construct(Loan $loan)
    {
        parent::__construct($loan);
    }

    /**
     * @param $data
     * @return mixed
     */
    public function createLoan($data)
    {
        $data['total_amount'] = $data['loan_amount'] + $data['loan_amount'] * ($data['interest_rate'] / 100);
        $data['user_id'] = auth()->user()->id;
        $data['loan_offer_date'] = $data['duration'];
        unset($data['duration']);
        return parent::create($data);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function loanVerify($id)
    {
        $loanInfo = parent::find($id);
        if ($loanInfo->verify === 0) {
            $loanInfo->loan_verify_date = $this->dateToEpoch(now()->toDateString());
            $loanInfo->duration_start_date = $this->dateToEpoch(now()->toDateString());
            $loanInfo->duration_end_date = $this->dateToEpoch(Carbon::now()->addMonth($loanInfo->repayment_frequency)->toDateString());
            $loanInfo->verify = 1;
            $loanInfo->save();
            return $loanInfo;
        }
        return null;

    }

    /**
     * @param $id
     * @return BaseRepository|BaseRepository[]|\Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|mixed|null
     */
    public function getLoanWithRepayment($id)
    {
        $loanInfo = parent::with(['repayments'])->find($id);
        return $loanInfo;
    }
}

