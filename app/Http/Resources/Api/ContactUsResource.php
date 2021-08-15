<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;

class ContactUsResource extends JsonResource
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
            'Name'=>$this->Name,
            'Email'=>$this->Email,
            'Phone'=>$this->Phone,
            'Message'=>$this->Message
        ];
    }
}
