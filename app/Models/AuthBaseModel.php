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

    public function scopeActivated($query){
        return $query->where('status',1);
    }
    public function scopeCreated_user_name(){
        return $this->created_user->name ?? 'System';
    }
    public function scopeUpdated_user_name(){
        return $this->updated_user->name ?? '--';
    }
    public function scopeDeleted_user_name(){
        return $this->deleted_user->name ?? '--';
    }
    public function scopeCreated_date(){
        return timeFormate($this->created_at);
    }
    public function scopeUpdated_date(){
        return ($this->updated_at != $this->created_at) ? timeFormate($this->updated_at) : '--';
    }
    public function scopeDeleted_date(){
        return timeFormate($this->deleted_at);
    }
    
}
