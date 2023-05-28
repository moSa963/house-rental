<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class HouseCollection extends JsonResource
{
    public function toArray($request)
    {
        return [
            "id" => $this->id,
            'name' => $this->name,
            'country' => $this->country,
            'city' => $this->city,
            'address' => $this->address,
            'zip' => $this->zip,
            'night_cost' => $this->night_cost,
            'active' => $this->active,
            'about' => $this->about,
            "user" => new UserResource($this->user),
            "images" => HouseImageResource::collection($this->images()->limit(5)->get()),
            "reviews_avg" => $this->reviews_avg_rating,
        ];
    }
}
