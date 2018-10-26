<?php

namespace App\Models;

use App\Helpers\epoch;
use App\Helpers\Uuids;
use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    use Uuids, epoch;
    public $incrementing = false;
    protected $guarded = [];
    protected $hidden = ['created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function loanType()
    {
        return $this->belongsTo(LoanType::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function repayments()
    {
        return $this->hasMany(Repayment::class);
    }

    /**
     * @param $value
     * @return string
     *
     *
     */
    public function getLoanOfferDateAttribute($value)
    {
        return $this->dateToEpoch($value);
    }

    /**
     * @param $value
     * @return string
     */
    public function setLoanOfferDateAttribute($value)
    {
        return $this->attributes['loan_offer_date'] = $this->epochToDate($value);
    }

    /**
     * @param $value
     * @return string
     *
     *
     */
    public function getLoanVerifyDateAttribute($value)
    {
        return $this->dateToEpoch($value);
    }

    /**
     * @param $value
     * @return string
     */
    public function setLoanVerifyDateAttribute($value)
    {
        return $this->attributes['loan_verify_date'] = $this->epochToDate($value);
    }

    /**
     * @param $value
     * @return string
     *
     */
    public function getDurationStartDateAttribute($value)
    {
        return $this->dateToEpoch($value);
    }

    /**
     * @param $value
     * @return string
     */
    public function setDurationStartDateAttribute($value)
    {
        return $this->attributes['duration_start_date'] = $this->epochToDate($value);
    }

    /**
     * @param $value
     * @return string
     *
     */
    public function getDurationEndDateAttribute($value)
    {
        return $this->dateToEpoch($value);
    }

    /**
     * @param $value
     * @return string
     */
    public function setDurationEndDateAttribute($value)
    {
        return $this->attributes['duration_end_date'] = $this->epochToDate($value);
    }


}

