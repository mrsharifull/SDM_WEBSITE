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

    public function getStatus()
    {
        if ($this->status == 1) {
            return 'Active';
        } else {
            return 'Deactive';
        }
    }
    public function getBtnStatus()
    {
        if ($this->status == 1) {
            return 'Deactive';
        } else {
            return 'Active';
        }
    }

    public function getStatusClass()
    {
        if ($this->status == 1) {
            return 'btn-success';
        } else {
            return 'btn-danger';
        }
    }
    public function getStatusBadgeClass()
    {
        if ($this->status == 1) {
            return 'badge badge-success';
        } else {
            return 'badge badge-warning';
        }
    }

    public function scopeActive($query){
        return $query->where('status',1);
    }
    
}
