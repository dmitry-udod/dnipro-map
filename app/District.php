<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\District
 *
 * @property int $id
 * @property string $name
 * @property string $slug
 * @property int $city_id
 * @property bool $is_active
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read string $active
 * @property-read string $category
 * @property-read string $city
 * @property-read string $type
 * @method static \Illuminate\Database\Eloquent\Builder|\App\District whereCityId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\District whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\District whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\District whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\District whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\District whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\District whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class District extends Model
{
    use CommonAttributes;
}
