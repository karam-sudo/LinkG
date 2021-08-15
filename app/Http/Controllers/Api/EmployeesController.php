<?php

namespace App\Http\Controllers\Api;

use App\Models\Employee;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;
use App\Http\Resources\Api\EmployeesResource;

class EmployeesController extends Controller
{
    public function getEmployee(){

        if (!Cache::has('employees')) {  

            $employees=Employee::with(['services','positions'])->get();

            Cache::remember('employees', now()->addMinute(1) , function () use ($employees){
                return $employees;
            });

        }

         $employees = Cache::get('employees');

         return  EmployeesResource::collection($employees);

     }  
     
}      
