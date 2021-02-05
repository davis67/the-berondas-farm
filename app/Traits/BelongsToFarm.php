<?php

namespace App\Traits;

use App\Scopes\FarmScope;

trait BelongsToFarm
{
    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function bootBelongsToFarm()
    {
        static::addGlobalScope(new FarmScope());

        static::creating(function ($model) {
            if (session()->has('farm_id')) {
                $model->farm_id = session()->get('farm_id');
            }
        });
    }
}
