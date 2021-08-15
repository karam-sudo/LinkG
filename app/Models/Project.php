<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Translatable\HasTranslations;

class Project extends Model
{
    use HasTranslations;
    public $translatable = ['Name','Description'];
    protected $guarded =[];
    protected $table = 'projects';


    // علاقة بين المشاريع  والصور لجلب اسم الصور  في جدول المشاريع
    public function images()
    {
        return $this->morphMany('App\Models\Image', 'imageable');
    }

    public function logos()
    {
        return $this->morphMany('App\Models\Logo', 'logoable');
    }


  //علاقة بين المشروع و الخدمة لجلب الخدمة بجدول المشاريع
  public function services()
  {
      return $this->belongsTo('App\Models\Service', 'Service_id');
  }

//delete from images table when the projects has been deleted
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
