<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    public $fillable= ['filename','imageable_id','imageable_type'];

    //polymorohic
    
    public function imageable()
    {
        return $this->morphTo();
    }
}
