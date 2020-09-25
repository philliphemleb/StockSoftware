<?php

namespace App;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Carbon;

/**
 * App\Item
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property int $amount
 * @property int $user_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read User $user
 * @method static Builder|Item newModelQuery()
 * @method static Builder|Item newQuery()
 * @method static Builder|Item query()
 * @method static Builder|Item whereAmount($value)
 * @method static Builder|Item whereCreatedAt($value)
 * @method static Builder|Item whereDescription($value)
 * @method static Builder|Item whereId($value)
 * @method static Builder|Item whereName($value)
 * @method static Builder|Item whereUpdatedAt($value)
 * @method static Builder|Item whereUserId($value)
 * @mixin Eloquent
 * @property-read Collection|Category[] $categories
 * @property-read int|null $categories_count
 * @property-read Collection|Tag[] $tags
 * @property-read int|null $tags_count
 * @property int|null $shelf
 * @property int|null $row
 * @property int|null $field
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Item whereField($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Item whereRow($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Item whereShelf($value)
 */
class Item extends Model
{
    protected $fillable = [
      'name', 'description', 'amount', 'user_id', 'shelf', 'row', 'field'
    ];

    /**
     * Get the User that created this item
     *
     * @return BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * Get the tags on this item.
     *
     * @return BelongsToMany
     */
    public function tags()
    {
        return $this->belongsToMany('App\Tag');
    }

    /**
     * Get the categories on this item.
     *
     * @return BelongsToMany
     */
    public function categories()
    {
        return $this->belongsToMany('App\Category');
    }
}
