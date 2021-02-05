<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Farm extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'contacts', 'address', 'is_active'];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'is_active' => 'boolean',
    ];

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
