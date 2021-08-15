<?php

namespace App\Http\Resources\Api;

use Illuminate\Support\Str;
use Illuminate\Http\Resources\Json\JsonResource;

class ImagesforGalleryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        //$Servicename=Str::slug($this->imageable->getTranslation('Name','en')
        return [
            'Image_Url'=>asset('/attachments/'.Str::slug($this->imageable->getTranslation('Description','en')).'/'.$this->filename),
        ];
    }
}
