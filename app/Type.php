<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Type
 *
 * @property int $id
 * @property string $name
 * @property string $slug
 * @property string $color
 * @property mixed|null $icon
 * @property int $order
 * @property int $city_id
 * @property int $category_id
 * @property bool $is_active
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read string $active
 * @property-read string $category
 * @property-read string $city
 * @property-read mixed $color_preview
 * @property-read string $type
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Type whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Type whereCityId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Type whereColor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Type whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Type whereIcon($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Type whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Type whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Type whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Type whereOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Type whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Type whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Type extends Model
{
    use CommonAttributes;

    public function getColorPreviewAttribute()
    {
        return "<div style='width:20px;height: 20px; border: 2px solid #b9bbbe; background-color: {$this->color}'></div>";
    }
}
