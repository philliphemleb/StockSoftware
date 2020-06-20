<?php

namespace App;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\Item
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property int $amount
 * @property int $created_by
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|Item newModelQuery()
 * @method static Builder|Item newQuery()
 * @method static Builder|Item query()
 * @method static Builder|Item whereAmount($value)
 * @method static Builder|Item whereCreatedAt($value)
 * @method static Builder|Item whereCreatedBy($value)
 * @method static Builder|Item whereDescription($value)
 * @method static Builder|Item whereId($value)
 * @method static Builder|Item whereName($value)
 * @method static Builder|Item whereUpdatedAt($value)
 * @mixin Eloquent
 */
class Item extends Model
{
    protected $attributes = [
      'created_by' => 0
    ];

    protected $fillable = [
      'name', 'description', 'amount', 'created_by'
    ];
}
