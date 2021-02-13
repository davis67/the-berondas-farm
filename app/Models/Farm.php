<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Farm extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'contacts', 'address', 'status'];

    /**
     * Returns the status color of the farm.
     *
     * @return string [<description>]
     */
    public function getCurrentStatusAttribute()
    {
        return true === $this->is_active ? 'active' : 'in-active';
    }

    /**
     * Returns the date of registration of the farm in human readible form.
     *
     * @return date [<description>]
     */
    public function getDateForHumansAttribute()
    {
        return $this->created_at->format('d M, Y');
    }
}
