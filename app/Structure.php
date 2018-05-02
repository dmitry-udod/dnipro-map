<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

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
        return Carbon::parse($this->created_at)->format('d.m.Y');
    }
}
