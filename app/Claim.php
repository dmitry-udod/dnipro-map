<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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
