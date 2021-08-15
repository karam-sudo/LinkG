<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Logo extends Model
{
    protected $guarded=[];

    public function logoable()
    {
        return $this->morphTo();
    }
}

