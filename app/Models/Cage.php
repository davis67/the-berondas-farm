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
     * Rabbit can be one or many cages.
     *
     * @return [type] [description]
     */
    public function rabbits()
    {
        return $this->belongsToMany(Rabbit::class)->withPivot('date_of_transfer', 'is_occupant');
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
}
