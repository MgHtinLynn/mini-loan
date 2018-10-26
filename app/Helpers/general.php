<?php
/**
 * Created by PhpStorm.
 * User: htinlynn
 * Date: 10/24/18
 * Time: 11:28 PM
 */

namespace App\Helpers;


trait general
{
    /**
     * @param $length
     * @param $count
     * @return array
     */
    public function randomDigit($length, $count)
    {
        $codes = [];
        $stringDigits = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz";

        while (count($codes) < $count) {
            $randomString = '';
            for ($i = 0; $i < $length; $i++) {
                $randomString = (string)$randomString . substr($stringDigits, rand(0, strlen($stringDigits) - 1), 1);
            }
            if (!in_array($randomString, $codes)) {
                $codes[] = (string)$randomString;
            }
        }

        return $codes;
    }
}