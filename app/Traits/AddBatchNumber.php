<?php

namespace App\Traits;

use App\Models\Cage;
use Illuminate\Support\Str;

trait AddBatchNumber
{
    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function bootAddBatchNumber()
    {
        static::creating(function ($model) {
            $model->batch_no = self::generateBatchNumber();
            $model->farm_id = session()->get('farm_id');
        });

        static::created(function ($batch) {
            for ($count = 0; $count < $batch->number_of_cages; ++$count) {
                Cage::create([
                    'batch_id' => $batch->id,
                    'cage_no' => self::generateCageNumber(),
                ]);
            }
        });
    }

    /**
     * Generate a unique random batch number of the batch.
     *
     * @return [type] [description]
     */
    private static function generateBatchNumber()
    {
        return 'BATCH-' . strtoupper(Str::random(6));
    }

    /**
     * Generate a unique cage number of the batch.
     *
     * @return [type] [description]
     */
    private static function generateCageNumber()
    {
        return 'CAGE-' . strtoupper(Str::random(6));
    }
}
