<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cage extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['cage_no', 'batch_id'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'is_occupant' => 'boolean',
    ];

    /**
     * Cage belongs To the Batch.
     *
     * @return [type] [description]
     */
    public function batch()
    {
        return $this->belongsTo(Batch::class);
    }

    /**
     * Current Rabbits in the cage.
     *
     * @return [type] [description]
     */
    public function getCurrentRabbitsAttribute()
    {
        return Rabbit::where('cage_id', $this->id)->get();
    }

    /**
     * Rabbit can be one or many cages.
     *
     * @return [type] [description]
     */
    public function rabbits()
    {
        return $this->hasToMany(Rabbit::class, 'cage_id');
    }

    /**
     * Transfer Rabbit to the cage.
     *
     * @return bool
     */
    public function transferRabbit($rabbit)
    {
        return $this->rabbits()->attach($rabbit, [
            'date_of_transfer' => now(),
            'is_occupant' => true,
        ]);
    }

    /**
     * Get 4months old male rabbit.
     *
     * @return bool
     */
    public function checkFourMonthsOldRabbitInCage()
    {
        return $this->rabbits()->pluck('age_number')->contains(function ($key, $value) {
            return $value >= 120;
        });
    }

    /**
     * Get total number of rabbits in the cage.
     *
     * @return mixed
     */
    public function totalRabbitsInCage()
    {
        return Rabbit::where('cage_id', $this->id)->count();
    }
}
