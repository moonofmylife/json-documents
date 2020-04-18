<?php

namespace App\Traits\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

trait UuidPrimaryKey
{
    /**
     * Boot the Model.
     */
    protected static function bootUuidPrimaryKey()
    {
        static::creating(function (Model $model) {
            $model->setAttribute($model->getKeyName(), Str::uuid()->toString());
        });
    }

    /**
     * Get the value indicating whether the IDs are incrementing.
     *
     * @return bool
     */
    public function getIncrementing()
    {
        return false;
    }

    /**
     * Get the auto-incrementing key type.
     *
     * @return string
     */
    public function getKeyType()
    {
        return 'string';
    }
}