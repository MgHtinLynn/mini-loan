<?php
/**
 * Created by PhpStorm.
 * User: htinlynn
 * Date: 10/24/18
 * Time: 11:29 PM
 */

namespace App\Helpers;


use Carbon\Carbon;

trait epoch
{
    /**
     * @param $value
     * @return float|int|null
     */
    public function dateToEpoch($value)
    {
        if ($value === null) {
            return null;
        }
        return Carbon::parse($value)->timestamp * 1000;
    }

    /**
     * @param $value
     * @return null|string
     */
    public function epochToDate($value)
    {
        if ($value === null) {
            return null;
        }
        return Carbon::createFromTimeStampUTC($value / 1000)->toDateString();
    }

    /**
     * @param $value
     * @param $format
     * @return null|string
     */
    public function epochToDateByDateFormat($value, $format)
    {
        if ($value == null) {
            return null;
        }
        return Carbon::createFromTimeStampUTC($value / 1000)->format($format);
    }
}

