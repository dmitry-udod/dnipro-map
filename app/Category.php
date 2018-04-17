<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public function getCityAttribute()
    {
    	return City::find($this->city_id)->name;
    }

    public function getActiveAttribute()
    {
    	return $this->is_active ? 'Так' : 'Нi';
    }
}
