<?php

namespace App;

trait CommonAttributes
{
    public function getCityAttribute()
    {
        $city = City::find($this->city_id);

        if ($city) {
            return $city->name;
        }
    }

    public function getCategoryAttribute()
    {
        $category = Category::find($this->category_id);

        if ($category) {
            return $category->name;
        }
    }

    public function getActiveAttribute()
    {
        return $this->is_active ? 'Так' : 'Нi';
    }
}
