<?php

namespace App\Models;

use Carbon\Carbon;
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

    /**
     * Date for Humans.
     *
     * @return Date
     */
    public function getDateForHumansAttribute()
    {
        return $this->created_at->format('d M, Y');
    }

    /**
     * Expense  Date for humans.
     *
     * @return Date
     */
    public function getExpenseDateForHumansAttribute()
    {
        return Carbon::parse($this->expense_date)->format('d M, Y');
    }
}
