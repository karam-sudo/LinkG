<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\ServicesResource;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class ServiceController extends Controller
{

    public function getServices()
    {

    if (!Cache::has('Services')) {  

    $Services = Service::with(['Projects'])->get();
    
    Cache::remember('Services', now()->addMinute(1) , function () use ($Services){
        return $Services;
    });

    }

    $Services = Cache::get('Services');
    
    return ServicesResource::collection($Services);
    }
}
