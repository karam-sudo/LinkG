<?php

namespace App\Http\Controllers\Api;

use App\Models\Gallery;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;
use App\Http\Resources\Api\GalleryResource;

class GalleryController extends Controller
{

    public function getGalleries()
    {
        if (!Cache::has('galleries')) {

            $galleries=Gallery::all();

            Cache::remember('galleries', now()->addMinute(1), function () use ($galleries){
                return $galleries;
            });

        }
            $galleries = Cache::get('galleries');

        return GalleryResource::collection($galleries);
    }
}
