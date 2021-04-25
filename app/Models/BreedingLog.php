<?php

namespace App\Models;

use Carbon\Carbon;
use App\Traits\BelongsToFarm;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BreedingLog extends Model
{
    use HasFactory;
    use BelongsToFarm;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['sire_id', 'dam_id', 'date_of_mating', 'expected_kiddle_date', 'kindle_date', 'litters', 'is_successful_mating', 'litters', 'dead_litters', 'doe_litters'];

    /**
     * Load relationship data.
     *
     * @return void
     */
    // protected $with = ['rabbit'];

    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->expected_kiddle_date = Carbon::parse($model->date_of_mating)->addDays(30);
        });
    }

    /**
     * Expected Date of birth.
     *
     * @return string
     */
    public function getDateOfMatingForHumansAttribute()
    {
        return Carbon::parse($this->date_of_mating)->format('d M, Y');
    }

    /**
     * Age number of the rabbit.
     *
     * @return string
     */
    public function getGestationPeriodAttribute()
    {
        return Carbon::now()->diffInDays(Carbon::parse($this->expected_kiddle_date), false);
    }

    /*
     * Age number of the rabbit.
     *
     * @return string
     */
}
