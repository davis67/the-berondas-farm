<?php

namespace App\Models;

use Carbon\Carbon;
use App\Traits\BelongsToFarm;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BreedingLog extends Model
{
	use HasFactory;
	use BelongsToFarm;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['sire_id', 'dam_id', 'date_of_mating', 'expected_kiddle_date', 'kindle_date', 'litters', 'is_successful_mating', 'litters', 'dead_litters', 'doe_litters'];

	/**
	 * Load relationship data.
	 *
	 * @return void
	 */
	protected $with = ['sire', 'dam'];

	/**
	 * The "booted" method of the model.
	 *
	 * @return void
	 */
	public static function boot()
	{
		parent::boot();

		static::creating(function ($model) {
			$model->expected_kiddle_date = Carbon::parse($model->date_of_mating)->addDays(30);
		});
	}

	/**
	 * Expected Date of birth in human readible form.
	 *
	 * @return string
	 */
	public function getExpectedKiddleDateForHumansAttribute()
	{
		return Carbon::parse($this->expected_kiddle_date)->format('d M, Y');
	}

	/**
	 * Date of birth in human readible form.
	 *
	 * @return string
	 */
	public function getKiddleDateForHumansAttribute()
	{
		return Carbon::parse($this->kiddle_date)->format('d M, Y');
	}

	/**
	 * Age number of the rabbit.
	 *
	 * @return string
	 */
	public function getAgeAttribute()
	{
		return Carbon::parse($this->kiddle_date)->diff(Carbon::now())->format('%y years, %m months and %d days');
	}

	/**
	 * Returns the date of the last update.
	 *
	 * @return date [<description>]
	 */
	public function getLastUpdateForHumansAttribute()
	{
		return Carbon::parse($this->updated_at)->format('d M, Y');
	}

	/**
	 * Returns the date of the mating in the human readible form.
	 *
	 * @return date [<description>]
	 */
	public function getDateOfMatingForHumansAttribute()
	{
		return Carbon::parse($this->date_of_mating)->format('d M, Y');
	}

	/**
	* Has one Dam.
	*
	* @return [type] [description]
	*/
	public function dam()
	{
		return $this->hasOne(Rabbit::class, 'dam_id');
	}

	/**
	* Has one sire.
	*
	* @return [type] [description]
	*/
	public function sire()
	{
		return $this->hasOne(Rabbit::class, 'sire_id');
	}
}
