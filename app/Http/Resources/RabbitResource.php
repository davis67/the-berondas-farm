<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class RabbitResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return array
     */
    public function toArray($request)
    {
        return [
            'rabbit_no' => $this->rabbit_no,
            'gender' => $this->gender,
            'date_of_birth' => $this->date_of_birth,
            'breed' => $this->breed,
            'farm_id' => $this->farm_id,
            'cage_id' => $this->cageS_id,
            'created_at' => $this->created_at,
        ];
    }
}
