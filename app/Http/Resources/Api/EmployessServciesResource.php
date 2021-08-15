<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;

class EmployessServciesResource extends JsonResource
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
        'Employees'=>EmployeesResource::collection($this->whenLoaded('Employees')),
        ];
    }
}
