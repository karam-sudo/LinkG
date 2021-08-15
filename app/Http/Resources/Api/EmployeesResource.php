<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;

class EmployeesResource extends JsonResource
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
            'id'=>$this->id,
            'Name_en'=>$this->getTranslation ('Name','en'),
            'Name_ar'=>$this->getTranslation('Name','ar'),
            'About_en'=>$this->getTranslation('About','en'),
            'About_ar'=>$this->getTranslation('About','ar'),
            'Service'=>new EmployessServciesResource($this->whenLoaded('services')),
            'images'=>ImagesResource::collection($this->images),
            'Posittion'=>new PositionsResource($this->whenLoaded('positions')),
        
        ];
    }
}
