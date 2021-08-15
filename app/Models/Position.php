<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Position extends Model
{
    use HasTranslations;
    public $translatable = ['Name','Description'];
    protected $fillable=['Name','Description'];
    protected $table = 'positions';
}
