<?php

namespace App\Action;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @property string $type
 * @property User $user
 * @property Entity $entity
 * @property string $detail
 * @property string $entity_type
 * @property int $entity_id
 * @property int $user_id
 */
class Activity extends Model
{
	use HasFactory;

	/**
	* Get the user this activity relates to.
	*/
	public function user(): BelongsTo
	{
		return $this->belongsTo(User::class);
	}
}
