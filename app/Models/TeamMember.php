<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Spatie\Translatable\HasTranslations;

class TeamMember extends Model
{
    use HasTranslations;
    public $translatable = ['Name','Address'];
    protected $guarded =[];
    protected $table = 'team_members';


    //علاقة بين العضو و الخدمة لجلب الخدمة بجدول الاعضاء
    public function services()
      {
          return $this->belongsTo('App\Models\Service', 'service_id');
      }

    //علاقة بين العضو و النوع لجلب النوع بجدول الاعضاء
    public function genders()
      {
          return $this->belongsTo('App\Models\Gender', 'gender_id');
      }

    //علاقة بين العضو و وقت العمل لجلب وقت العمل بجدول الاعضاء
      public function job_times()
      {
          return $this->belongsTo('App\Models\JobTime', 'jobtime_id');
      }

    //علاقة بين العضو و نوع العمل لجلب نوع العمل بجدول الاعضاء
      public function job_types()
      {
          return $this->belongsTo('App\Models\JobType', 'jobtype_id');
      }

    //علاقة بين العضو و العملة لجلب العملة بجدول الاعضاء
      public function currencies()
      {
          return $this->belongsTo('App\Models\Currency', 'currency_id');
      }

    //علاقة بين العضو و المكان الوظيفي لجلب المكان الوظيفي بجدول الاعضاء
      public function positions()
      {
          return $this->belongsTo('App\Models\Position', 'position_id');
      }

    //علاقة بين العضو و الصور لجلب اسم الصورة بجدول الاعضاء
      public function images()
    {
        return $this->morphMany('App\Models\Image', 'imageable');
    }
//delete from images table when the Teammember has been deleted
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
