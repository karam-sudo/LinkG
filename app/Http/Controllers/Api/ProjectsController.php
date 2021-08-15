<?php

namespace App\Http\Controllers\Api;

use App\Models\Project;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;
use App\Http\Resources\Api\ProjectsResource;

class ProjectsController extends Controller
{
   public function getProjects()
   {
        if (!Cache::has('projects')) {  
            
            $projects=Project::all();

            Cache::remember('projects', now()->addMinute(1), function () use ($projects){
                return $projects;
            });

        }
            $projects = Cache::get('projects');

        return ProjectsResource::collection($projects);
   }
}
