<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $attributes = [
      'created_by' => 0
    ];

    protected $fillable = [
      'name', 'description', 'amount', 'created_by'
    ];
}
