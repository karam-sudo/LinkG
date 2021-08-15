<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Gallery extends Model
{
    use HasTranslations;

    public $translatable = ['Description'];
    protected $fillable=['Description'];
    protected $table = 'galleries';



    public function images()
    {
        return $this->morphMany('App\Models\Image', 'imageable');
    }


    //delete from images table when the gallery has been deleted
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
