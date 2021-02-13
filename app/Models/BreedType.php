<?php

namespace App\Models;

use App\Traits\BelongsToFarm;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BreedType extends Model
{
    use HasFactory;
    use BelongsToFarm;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'description'];

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
