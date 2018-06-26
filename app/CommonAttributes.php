<?php

namespace App;

trait CommonAttributes
{
    /**
     *  Get readable city name
     *
     * @return string
     */
    public function getCityAttribute()
    {
        $city = City::find($this->city_id);

        if ($city) {
            return $city->name;
        }
    }

    /**
     * Get readable category name
     *
     * @return string
     */
    public function getCategoryAttribute()
    {
        $category = Category::find($this->category_id);

        if ($category) {
            return $category->name;
        }
    }

    /**
     * Is entity active
     *
     * @return string
     */
    public function getActiveAttribute()
    {
        return $this->is_active ? 'Так' : 'Нi';
    }

    /**
     * Get readable type name
     *
     * @return string
     */
    public function getTypeAttribute()
    {
        $type = Type::find($this->type_id);

        if ($type) {
            return $type->name;
        }
    }
}
