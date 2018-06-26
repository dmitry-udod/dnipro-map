<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    use CommonAttributes;

    public function getColorPreviewAttribute()
    {
        return "<div style='width:20px;height: 20px; border: 2px solid #b9bbbe; background-color: {$this->color}'></div>";
    }
}
