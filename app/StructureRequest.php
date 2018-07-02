<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\StructureRequest
 *
 * @property int $id
 * @property string $address
 * @property string $latitude
 * @property string $longitude
 * @property string $name
 * @property string $email
 * @property string $description
 * @property array $photos
 * @property bool $is_processed
 * @property string|null $processed_by
 * @property string|null $processed_at
 * @property string $uuid
 * @property int $city_id
 * @property int $category_id
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read string $active
 * @property-read string $category
 * @property-read string $city
 * @property-read mixed $photo_previews
 * @property-read string $processed
 * @property-read string $type
 * @method static \Illuminate\Database\Eloquent\Builder|\App\StructureRequest whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\StructureRequest whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\StructureRequest whereCityId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\StructureRequest whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\StructureRequest whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\StructureRequest whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\StructureRequest whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\StructureRequest whereIsProcessed($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\StructureRequest whereLatitude($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\StructureRequest whereLongitude($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\StructureRequest whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\StructureRequest wherePhotos($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\StructureRequest whereProcessedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\StructureRequest whereProcessedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\StructureRequest whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\StructureRequest whereUuid($value)
 * @mixin \Eloquent
 */
class StructureRequest extends Model
{
    use CommonAttributes;

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'photos' => 'array',
    ];

       /**
     * Is claim processed
     *
     * @return string
     */
    public function getProcessedAttribute()
    {
        return $this->is_processed ? '<span class="badge badge-success">Так</span>' : '<span class="badge badge-danger">Нi</span>';
    }

    public function getPhotoPreviewsAttribute()
    {
        $html = '';

        foreach ($this->photos as $photo) {
            $photo = json_decode($photo, true);
            $html .= '<img src="/uploads/structure_requests/' . $this->id . '/' .$photo['name'] . '" width="100" height="75" style="border: 1px solid #ebebeb; margin:5px">';
        }

        return $html;
    }
}
