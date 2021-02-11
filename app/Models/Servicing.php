<?php

namespace App\Models;

use Carbon\Carbon;
use App\Traits\BelongsToFarm;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Servicing extends Model
{
    use HasFactory;
    use BelongsToFarm;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['mother_id', 'father_id', 'date_of_servicing', 'expected_date_of_birth', 'actual_date_of_birth', 'number_of_kits'];

    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->expected_date_of_birth = Carbon::parse($model->date_of_servicing)->addDays(30);
        });
    }

    public function getMotherAttribute()
    {
        return Rabbit::findOrFail($this->mother_id);
    }

    /**
     * Age number of the rabbit.
     *
     * @return string
     */
    public function getGestationPeriodAttribute()
    {
        return Carbon::now()->diffInDays(Carbon::parse($this->expected_date_of_birth), false);
    }

    /**
     * Age number of the rabbit.
     *
     * @return string
     */
    public function rabbit()
    {
        return $this->hasOne(Rabbit::class, 'servicing_id');
    }
}
