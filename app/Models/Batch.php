<?php

namespace App\Models;

use App\Traits\AddBatchNumber;
use App\Traits\BelongsToFarm;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Batch extends Model
{
    use HasFactory;
    use BelongsToFarm;
    use AddBatchNumber;

    protected $fillable = ['date_of_construction', 'cost_of_construction', 'number_of_cages', 'expected_number_of_rabbits'];
}
