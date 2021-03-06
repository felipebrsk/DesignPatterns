<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

/**
 * @method static creating(\Closure $param)
 */
trait HasPassword {
    public static function bootHasPassword() {
        static::creating(function (Model $model) {
            $model->password = Hash::make($model->password);
        });
    }
}