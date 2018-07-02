<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Structure
 *
 * @property int $id
 * @property string $address
 * @property string|null $name
 * @property string $uuid
 * @property int $city_id
 * @property int $category_id
 * @property int|null $type_id
 * @property int|null $district_id
 * @property string|null $area
 * @property string|null $business
 * @property string|null $owner
 * @property string|null $renter
 * @property string|null $notes
 * @property string|null $author_phone
 * @property string|null $author_email
 * @property string|null $url
 * @property string|null $working_hours
 * @property string|null $phone
 * @property string|null $latitude
 * @property string|null $longitude
 * @property string|null $zoom
 * @property array $photos
 * @property bool $is_active
 * @property bool $has_problem
 * @property bool $is_free
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property array $additional_fields
 * @property string|null $director
 * @property bool|null $has_contract
 * @property string|null $contract_number
 * @property string|null $contract_start_at
 * @property string|null $contract_finish_at
 * @property string|null $registry_number
 * @property-read string $active
 * @property-read string $category
 * @property-read string $city
 * @property-read mixed $created_at_short
 * @property-read mixed $photo_previews
 * @property-read mixed $problem
 * @property-read mixed $type_as_text
 * @property-read string $type
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Structure whereAdditionalFields($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Structure whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Structure whereArea($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Structure whereAuthorEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Structure whereAuthorPhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Structure whereBusiness($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Structure whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Structure whereCityId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Structure whereContractFinishAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Structure whereContractNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Structure whereContractStartAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Structure whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Structure whereDirector($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Structure whereDistrictId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Structure whereHasContract($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Structure whereHasProblem($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Structure whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Structure whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Structure whereIsFree($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Structure whereLatitude($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Structure whereLongitude($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Structure whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Structure whereNotes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Structure whereOwner($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Structure wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Structure wherePhotos($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Structure whereRegistryNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Structure whereRenter($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Structure whereTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Structure whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Structure whereUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Structure whereUuid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Structure whereWorkingHours($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Structure whereZoom($value)
 * @mixin \Eloquent
 */
class Structure extends Model
{
    use CommonAttributes;

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'photos' => 'array',
        'additional_fields' => 'array',
    ];

    public function getPhotoPreviewsAttribute()
    {
        $html = '';

        foreach ($this->photos as $photo) {
            $html = '<img src="/uploads/structures/' . $photo['name'] . '" width="100" height="75">';
            break;
        }

        return $html;
    }

    public function getProblemAttribute()
    {
        return $this->has_problem ? 'Так' : 'Нi';
    }

    public function getCreatedAtShortAttribute()
    {
        return Carbon::parse($this->created_at)->format('d.m.Y H:i');
    }

    public function getTypeAsTextAttribute()
    {
        return optional(Type::find($this->type_id))->name;
    }
}
