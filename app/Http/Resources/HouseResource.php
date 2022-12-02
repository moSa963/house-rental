<?php

namespace App\Http\Resources;

use App\Services\HouseService;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

class HouseResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
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
            "images" => HouseImageResource::collection($this->images),
            "features" => HouseFeatureResource::collection($this->features),
            "rules" => HouseRuleResource::collection($this->rules),
            "reviews_avg" => $this->reviews()->avg("rating"),
            "add_review" => Auth::check() ? HouseService::userCanAddReview($request->user(), $this) : false,
        ];  
    }
}
