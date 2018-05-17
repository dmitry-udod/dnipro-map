<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use CommonAttributes;

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'additional_fields' => 'array',
    ];
}
