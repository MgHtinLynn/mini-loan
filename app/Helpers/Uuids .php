<?php
/**
 * Created by PhpStorm.
 * User: htinlynn
 * Date: 10/24/18
 * Time: 11:29 PM
 */

namespace App\Helpers;
use Webpatser\Uuid\Uuid;

trait Uuids
{
    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->{$model->getKeyName()} = Uuid::generate()->string;
        });
    }
}
