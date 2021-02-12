<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ExpenseType extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'description', 'farm_id'];

    /**
     * Has Many.
     *
     * @return [type] [description]
     */
    public function expenses()
    {
        return $this->hasMany(Expense::class);
    }
}
