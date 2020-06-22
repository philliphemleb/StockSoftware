<?php

namespace App;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Tag
 *
 * @method static Builder|Tag newModelQuery()
 * @method static Builder|Tag newQuery()
 * @method static Builder|Tag query()
 * @mixin Eloquent
 */
class Tag extends Model
{
    protected $fillable = [
        'name'
    ];

    public function Items()
    {
        return $this->belongsToMany('App\Item');
    }
}
