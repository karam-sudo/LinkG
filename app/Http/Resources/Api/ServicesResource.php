<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;

class ServicesResource extends JsonResource
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
            'Decs_en'=>$this->getTranslation('Description','en'),
            'Decs_ar'=>$this->getTranslation('Description','ar'),
            'images'=> ImagesResource::collection($this->images),
            'projects'=>ProjectsResource::collection($this->whenLoaded('Projects')),
            'Employees'=>EmployeesResource::collection($this->whenLoaded('Employees')),
            
        ];
    }
}
