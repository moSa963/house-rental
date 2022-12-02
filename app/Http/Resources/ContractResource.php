<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ContractResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            "id" => $this->id,
            'user' => new UserResource($this->user),
            'owner' => new UserResource($this->owner()->first()),
            'house_id' => $this->house_id,
            'guests' => $this->guests,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'total_price' => $this->total_price,
            'confirmed' => $this->confirmed,
        ];
    }
}
