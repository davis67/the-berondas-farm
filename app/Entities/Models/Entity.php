<?php

namespace App\Models\Action;

use App\Interfaces\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Entity
 * The base class for book-like items such as pages, chapters & books.
 * This is not a database model in itself but extended.
 *
 * @property int $id
 * @property string $name
 * @property string $slug
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property int $created_by
 * @property int $updated_by
 * @property boolean $restricted
 * @property Collection $tags
 * @method static Entity|Builder visible()
 * @method static Entity|Builder hasPermission(string $permission)
 * @method static Builder withLastView()
 * @method static Builder withViewCount()
 */
abstract class Entity extends Model implements Sluggable
{
	use HasFactory;

	/**
	 * Gets the activity objects for this entity.
	 */
	public function activity(): MorphMany
	{
		return $this->morphMany(Activity::class, 'entity')
			->orderBy('created_at', 'desc');
	}

	/**
	 * @inheritdoc
	 */
	public function refreshSlug(): string
	{
		$this->slug = app(SlugGenerator::class)->generate($this);
		return $this->slug;
	}
}
