<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Support\Facades\DB;

class Service extends Model
{
    use HasTranslations;

    public $translatable = ['Name','Description'];
    protected $fillable=['Name','Description'];
    protected $table = 'services';



    // علاقة  الخدمات لجلب المشاريع المتعلقة بكل خدمة
    public function Projects()
    {
        return $this->hasMany('App\Models\Project', 'Service_id');
    }

     // علاقة  الخدمات لجلب الاماكن الوظيفية المتعلقة بكل خدمة
     public function Positions()
     {
         return $this->hasMany('App\Models\Position', 'Service_id');
     }

       // علاقة  الخدمات لجلب الاعضاء المتعلقين بكل خدمة
       public function TeamMembers()
       {
           return $this->hasMany('App\Models\TeamMember', 'service_id');
       }

        // علاقة  الخدمات لجلب الموظفين المتعلقين بكل خدمة
        public function Employees()
        {
            return $this->hasMany('App\Models\Employee', 'service_id');
        }


          //علاقة بين الخدمة و الصور لجلب اسم الصورة بجدول الخدمات
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
