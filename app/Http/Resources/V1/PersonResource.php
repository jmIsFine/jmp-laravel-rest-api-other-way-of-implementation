<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Resources\Json\JsonResource;

class PersonResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        //Default
        //return parent::toArray($request);

        //Specified Column name
        return [
            'id' => $this->id,
            'Name' => $this->Name,
            'Email' => $this->Email,
            'Phone' => $this->Phone
        ];
    }
}
