<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Structure extends Model
{
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'photos' => 'array',
    ];
}
