<?php

namespace App\Models;
use Spatie\Permission\Traits\HasRoles;
use Spatie\Permission\Models\Role;
class Admin extends AuthBaseModel
{
    use HasRoles;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id',
    ];
    protected $hidden = [
        'password',
        'remember_token',
    ];
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    function role(){
        return $this->belongsTo(Role::class,'role_id');
    }

    
}
