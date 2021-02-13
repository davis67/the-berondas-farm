<?php

namespace App\Models;

use App\Traits\BelongsToFarm;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Expense extends Model
{
    use HasFactory;
    use BelongsToFarm;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['expense_date', 'expense_type_id', 'amount', 'farm_id'];

    /**
     * Expense belongs To the ExpenseType.
     *
     * @return [type] [description]
     */
    public function category()
    {
        return $this->belongsTo(ExpenseType::class, 'expense_type_id');
    }

    public function getDateForHumansAttribute()
    {
        return $this->created_at->format('d M, Y');
    }
}
