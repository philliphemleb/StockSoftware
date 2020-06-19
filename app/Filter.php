<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Filter extends Model
{
    protected $attributes = [
      'created_by' => 0
    ];

    protected $fillable = [
      'name', 'description', 'created_by'
    ];
}
