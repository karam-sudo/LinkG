<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Spatie\Translatable\HasTranslations;

class Employee extends Model
{
    use HasTranslations;

    public $translatable = ['Name','About'];
    protected $guarded =[];
    protected $table='employees';


     //علاقة بين الموظف و الخدمة لجلب الخدمة بجدول الموظفين
     public function services()
     {
         return $this->belongsTo('App\Models\Service', 'service_id');
     }

         //علاقة بين الموظف و المكان الوظيفي لجلب المكان الوظيفي بجدول الموظف
         public function positions()
         {
             return $this->belongsTo('App\Models\Position', 'position_id');
         }
   
       //علاقة بين الموظف و الصور لجلب اسم الصورة بجدول الموظف
         public function images()
       {
           return $this->morphMany('App\Models\Image', 'imageable');
       }
       //delete from images table when the employee has been deleted
       public function delete()
       {
         DB::beginTransaction();
              $res=parent::delete();
              
              if($res==true)
              {
                       $relations=$this->morphMany('App\Models\Image', 'imageable');
   
                       
                       $relations->delete(); 
               }
   
               DB::commit();    
       }
}
