<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PreviousRecord extends Model
{
    use CommonAttributes;

    /**
     * Is claim processed
     *
     * @return string
     */
    public function getProcessedAttribute()
    {
        return $this->is_processed ? '<span class="badge badge-success">Так</span>' : '<span class="badge badge-danger">Нi</span>';
    }

    public function getStructureNameAttribute()
    {
        return Structure::find($this->structure_id)->name;
    }
}
