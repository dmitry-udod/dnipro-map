<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Category
 *
 * @property int $id
 * @property string $name
 * @property string $slug
 * @property int $city_id
 * @property int $order
 * @property bool $is_active
 * @property mixed|null $logo
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property bool $user_can_create_claims
 * @property array $additional_fields
 * @property int|null $responsible_user_id
 * @property-read string $active
 * @property-read string $category
 * @property-read string $city
 * @property-read string $type
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Category whereAdditionalFields($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Category whereCityId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Category whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Category whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Category whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Category whereLogo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Category whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Category whereOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Category whereResponsibleUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Category whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Category whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Category whereUserCanCreateClaims($value)
 * @mixin \Eloquent
 */
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
