<?php

namespace App\Models;

use Carbon\Carbon;
use App\Traits\BelongsToFarm;
use App\Traits\GenerateRabbitNumber;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Rabbit extends Model
{
    use HasFactory;
    use GenerateRabbitNumber;
    use BelongsToFarm;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['breed', 'date_of_birth', 'status', 'gender', 'rabbit_no', 'farm_id', 'servicing_id', 'cage_id'];

    /**
     * Load relationship data.
     *
     * @return void
     */
    protected $with = ['currentCage'];

    /**
     * Returns the current cage info of the rabbit.
     *
     * @return [type] [description]
     */
    public function currentCage()
    {
        return self::findOrFail($this->cage_id);
    }

    /**
     * Cage has one or many rabbits.
     *
     * @return [type] [description]
     */
    public function cages()
    {
        return $this->belongsToMany(Cage::class)->withPivot('date_of_transfer', 'is_occupant');
    }

    /**
     * Age of the rabbit.
     *
     * @return string
     */
    public function age()
    {
        return Carbon::parse($this->date_of_birth)->diff(Carbon::now())->format('%y years, %m months and %d days');
    }

    /**
     * Age number of the rabbit.
     *
     * @return string
     */
    public function getAgeNumberAttribute()
    {
        return Carbon::parse($this->date_of_birth)->diffInDays(Carbon::now(), false);
    }

    /**
     * Get male rabbit.
     *
     * @return string
     */
    public function isMale()
    {
        return 'male' == $this->gender;
    }

    /**
     * Get female rabbit.
     *
     * @return string
     */
    public function isFemale()
    {
        return 'female' == $this->gender;
    }

    /**
     * Returns the date of registration of the farm in human readible form.
     *
     * @return date [<description>]
     */
    public function getDateForHumansAttribute()
    {
        return Carbon::parse($this->created_at)->format('d M, Y');
    }
}
