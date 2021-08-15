<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;

class GalleryResource extends JsonResource
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
            'Decs_en'=>$this->getTranslation('Description','en'),
            'Decs_ar'=>$this->getTranslation('Description','ar'),
            'images'=> ImagesforGalleryResource::collection($this->images),

        ];
    }
}
