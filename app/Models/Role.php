<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Permission\Traits\HasRoles;
use Spatie\Permission\Models\Role as SpatieRole;

class Role extends SpatieRole
{
    use HasFactory, HasRoles;
    function created_user(){
        return $this->belongsTo(Admin::class,'created_by');
    }
    function updated_user(){
        return $this->belongsTo(Admin::class,'updated_by');
    }
    function deleted_user(){
        return $this->belongsTo(Admin::class,'deleted_by');
    }
}
