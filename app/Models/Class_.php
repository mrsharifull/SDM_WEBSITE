<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Class_ extends BaseModel
{
    use HasFactory;
    protected $table = 'classes';

    function sections(){
        return $this->hasMany(Section::class,'class_id','id');
    }
}
