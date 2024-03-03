<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class AuthBaseModel extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    function created_user(){
        return $this->belongsTo(Admin::class,'created_by');
    }
    function updated_user(){
        return $this->belongsTo(Admin::class,'updated_by');
    }
    function deleted_user(){
        return $this->belongsTo(Admin::class,'deleted_by');
    }

    function getStatusBadgeClass(){
        if($this->status ==1 ){
            return 'badge badge-success';
        }else{
            return 'badge badge-warning';
        }
    }
    function getStatus(){
        if($this->status ==1 ){
            return 'Active';
        }else{
            return 'Deactive';
        }
    }
    
}
