<?php

namespace App\Http\Resources\Resource;

use App\Car;
use App\user;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'name' => $this->name,
            'surname' => $this->surname,
            'birth_date' => $this->birth_date,
            'phone_number' => $this->phone_number,
            'email' => $this->email,
            'cars' => $this->cars,

        ];
    }
}
