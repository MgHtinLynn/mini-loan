<?php
/**
 * Created by PhpStorm.
 * User: htinlynn
 * Date: 10/26/18
 * Time: 1:23 PM
 */

namespace App\Http\Repositories\Transaction;


use App\Http\Repositories\BaseRepository;
use App\Models\Transaction;

class TransactionRepository extends BaseRepository
{

    /**
     * TransactionRepository constructor.
     * @param Transaction $transaction
     */
    public function __construct(Transaction $transaction)
    {
        parent::__construct($transaction);
    }

    /**
     * @param $repaymentId
     */
    public function createTransaction($repaymentId)
    {
        parent::create(['repayment_id' => $repaymentId, 'transaction_amount' => request()->input('amount')]);
    }
}
