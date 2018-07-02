<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Claim
 *
 * @property int $id
 * @property string $name
 * @property string $phone
 * @property string $email
 * @property string $claim_category_id
 * @property string $description
 * @property array $photos
 * @property bool $is_processed
 * @property string|null $processed_by
 * @property string|null $processed_at
 * @property string $uuid
 * @property int $city_id
 * @property int $category_id
 * @property int $structure_id
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property string|null $response
 * @property string $address
 * @property-read string $active
 * @property-read string $category
 * @property-read string $city
 * @property-read string $claim_category
 * @property-read mixed $photo_previews
 * @property-read string $processed
 * @property-read string $type
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Claim whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Claim whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Claim whereCityId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Claim whereClaimCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Claim whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Claim whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Claim whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Claim whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Claim whereIsProcessed($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Claim whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Claim wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Claim wherePhotos($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Claim whereProcessedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Claim whereProcessedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Claim whereResponse($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Claim whereStructureId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Claim whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Claim whereUuid($value)
 * @mixin \Eloquent
 */
class Claim extends Model
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
     * Get claim structure address
     * 
     * @return string
     */
    public function getAddressAttribute()
    {
        $structure = Structure::find($this->structure_id);

        return optional($structure)->address;
    }

    /**
     * Get claim category description
     *
     * @return string
     */
    public function getClaimCategoryAttribute()
    {
        return ClaimCategory::all()[$this->claim_category_id];
    }

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
            $html .= '<img src="/uploads/claims/' . $this->id . '/' .$photo['name'] . '" width="100" height="75" style="border: 1px solid #ebebeb; margin:5px">';
        }

        return $html;
    }
}
