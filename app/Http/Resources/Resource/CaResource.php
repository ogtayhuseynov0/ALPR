<?php

namespace App\Http\Resources\Resource;

use Illuminate\Http\Resources\Json\JsonResource;

class CaResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return[
            'id' => $this->id,
            'user_id' => $this->user_id,
            'licence_plate' => $this->licence_plate,
            'color' => $this->color,
            'model' => $this->model,
        ];
    }
}
