<?php

namespace App;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Category
 *
 * @property-read Collection|Item[] $Items
 * @property-read int|null $items_count
 * @method static Builder|Category newModelQuery()
 * @method static Builder|Category newQuery()
 * @method static Builder|Category query()
 * @mixin Eloquent
 */
class Category extends Model
{
    protected $fillable = [
        'name', 'description'
    ];

    protected $attributes = [
        'description' => '',
    ];

    public function Items()
    {
        return $this->belongsToMany('App\Item');
    }
}
