<?php

namespace App\Models;

use App\Traits\BelongsToFarm;
use App\Traits\GenerateRabbitNumber;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Rabbit extends Model
{
    use HasFactory;
    use GenerateRabbitNumber;
    use BelongsToFarm;

    protected $fillable = ['breed', 'date_of_birth', 'status', 'gender', 'rabbit_no', 'farm_id'];

    /**
     * Cage has one or many rabbits.
     *
     * @return [type] [description]
     */
    public function cages()
    {
        return $this->belongsToMany(Cage::class);
    }
}
