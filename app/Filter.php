<?php

namespace App;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\Filter
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property int $created_by
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|Filter newModelQuery()
 * @method static Builder|Filter newQuery()
 * @method static Builder|Filter query()
 * @method static Builder|Filter whereCreatedAt($value)
 * @method static Builder|Filter whereCreatedBy($value)
 * @method static Builder|Filter whereDescription($value)
 * @method static Builder|Filter whereId($value)
 * @method static Builder|Filter whereName($value)
 * @method static Builder|Filter whereUpdatedAt($value)
 * @mixin Eloquent
 */
class Filter extends Model
{
    protected $attributes = [
      'created_by' => 0
    ];

    protected $fillable = [
      'name', 'description', 'created_by'
    ];
}
