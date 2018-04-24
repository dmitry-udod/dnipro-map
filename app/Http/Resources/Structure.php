<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Structure extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'address' => $this->address,
            'name' => $this->name,
            'email' => $this->email,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'is_active' => $this->is_active,
            'has_problem' => $this->has_problem,
        ];
    }
}
