<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;

class ProjectsResource extends JsonResource
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
            'Service_id'=>$this->Service_id,
            //'services'=> ServicesResource::collection($this->whenLoaded('services')),
            'service_name'=>$this->services->getTranslation ('Name','en'),
            'Name_en'=>$this->getTranslation ('Name','en'),
            'Name_ar'=>$this->getTranslation('Name','ar'),
            'Decs_en'=>$this->getTranslation('Description','en'),
            'Decs_ar'=>$this->getTranslation('Description','ar'),
            'WebSite'=>$this->webLink,
            'GooglePlay'=>$this->googleplayLink,
            'AppStore'=>$this->appstoreLink,
            'images'=> ImagesResource::collection($this->images),
            'logo'=> LogoResource::collection($this->logos),
            
           
        ];
    }
}
