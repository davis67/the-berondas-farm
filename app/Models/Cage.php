<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cage extends Model
{
    use HasFactory;

    protected $fillable = ['cage_no', 'batch_id'];

    /**
     * Cage belongs To the Batch.
     *
     * @return [type] [description]
     */
    public function batch()
    {
        return $this->belongsTo(Batch::class);
    }
}
