<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Str;

class LogoResource extends JsonResource
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
            'logo_Url'=>asset('/attachments/'.Str::slug($this->logoable->getTranslation('Name','en')).'/'.$this->filename),
        ];
    }
}
