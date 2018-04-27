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
            'category_id' => object_get($this,'category_id', ''),
            'district_id' => object_get($this,'district_id', ''),
            'type_id' => object_get($this,'type_id', ''),
            'name' => $this->name,
            'email' => $this->email,
            'author_phone' => $this->author_phone,
            'author_email' => $this->author_email,
            'uuid' => $this->uuid,
            'business' => $this->business,
            'area' => $this->area,
            'owner' => $this->owner,
            'renter' => $this->renter,
            'notes' => $this->notes,
            'phone' => $this->phone,
            'url' => $this->url,
            'working_hours' => $this->working_hours,
            'photos' => object_get($this,'photos', []),
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'is_active' => object_get($this,'is_active', true),
            'is_free' => object_get($this,'is_free'),
            'has_problem' => $this->has_problem,
        ];
    }
}
