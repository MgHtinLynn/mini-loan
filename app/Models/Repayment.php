<?php

namespace App\Models;

use App\Helpers\epoch;
use App\Helpers\Uuids;
use Illuminate\Database\Eloquent\Model;

class Repayment extends Model
{
    use Uuids, epoch;
    public $incrementing = false;
    protected $guarded = [];
    protected $hidden = ['created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function loan()
    {
        return $this->belongsTo(Loan::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}
