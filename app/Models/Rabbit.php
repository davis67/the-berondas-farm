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

	const GENDER = [
		'doe' => 'Doe',
		'buck' => 'Buck',
		'dam' => 'Dam',
		'sire' => 'Sire',
		'unknown' => 'Unknown',
	];

	const STATUS = [
		'alive' => 'Alive',
		'sold' => 'Sold',
		'dead' => 'Dead',
	];

	/**
	 * The attributes that should be cast to native genders.
	 *
	 * @var array
	 */
	protected $casts = [
		'date_of_birth' => 'date:Y-m-d',
	];

	/**
	 * Returns the current cage info of the rabbit.
	 *
	 * @return [type] [description]
	 */
	protected $fillable = ['breed', 'date_of_birth', 'status', 'gender', 'rabbit_no', 'farm_id', 'servicing_id', 'cage_id'];

	/**
	 * Returns the current cage info of the rabbit.
	 *
	 * @return [type] [description]
	 */
	public function cage()
	{
		return $this->belongsTo(Cage::class, 'cage_id');
	}

	/**
	 * Returns the logs info of the rabbit.
	 *
	 * @return [type] [description]
	 */
	public function getLogsAttribute()
	{
		return BreedingLog::where('sire_id', $this->id)->get() ?? null;
	}

	/**
	 * Scope a query to only include alive rabbits.
	 *
	 * @param \Illuminate\Database\Eloquent\Builder $query
	 *
	 * @return \Illuminate\Database\Eloquent\Builder
	 */
	public function scopeAlive($query)
	{
		return $query->where('status', 'alive');
	}

	/**
	 * Scope a query to only include rabbits of a given gender.
	 *
	 * @param \Illuminate\Database\Eloquent\Builder $query
	 * @param mixed                                 $type
	 *
	 * @return \Illuminate\Database\Eloquent\Builder
	 */
	public function scopeOfGender($query, $gender)
	{
		return $query->where('gender', $gender);
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

	/**
	 * Returns the date of registration of the farm in human readible form.
	 *
	 * @return date [<description>]
	 */
	public function getDateOfBirthForHumansAttribute()
	{
		return Carbon::parse($this->date_of_birth)->format('d M, Y');
	}
}
