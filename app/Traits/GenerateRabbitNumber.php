<?php

namespace App\Traits;

use Illuminate\Support\Str;

trait GenerateRabbitNumber
{
    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function bootGenerateRabbitNumber()
    {
        static::creating(function ($model) {
            $model->rabbit_no = self::randomRabbitNumber();
        });
    }

    /**
     * Generate a unique random rabbit number of the batch.
     *
     * @return [type] [description]
     */
    private static function randomRabbitNumber()
    {
        return 'RBT-' . strtoupper(Str::random(6));
    }
}
