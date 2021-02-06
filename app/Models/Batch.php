<?php

namespace App\Models;

use App\Traits\BelongsToFarm;
use App\Traits\AddBatchNumber;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Batch extends Model
{
    use HasFactory;
    use BelongsToFarm;
    use AddBatchNumber;

    protected $fillable = ['date_of_construction', 'cost_of_construction', 'number_of_cages', 'expected_number_of_rabbits'];

    /**
     * Batch has many cages.
     *
     * @return [type] [description]
     */
    public function cages()
    {
        return $this->hasMany(Cage::class);
    }
}
