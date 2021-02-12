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
	 * The attributes that should be cast to native types.
	 *
	 * @var array
	 */
	protected $casts = [
		'is_occupant' => 'boolean',
	];

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
}
