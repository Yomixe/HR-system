<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

use App\Departments;
use App\Employee;
use App\Contact;
class User extends Authenticatable
{
    protected $table='users';
    use Notifiable;
  
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name','last_name', 'username', 'email','password', 'date_of_birth', 'remember_token','status','department_id',
    ];
   
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function roles() {
        return $this->belongsToMany(Roles::class,'users_has_roles','user_id','role_id')->withTimestamps();
    }
    public function departments() {
        return $this->belongsTo(Departments::class,'department_id');
    }
    public function employees() {
        return $this->belongsTo(Employee::class,'employee_id');
    }
    public function contacts() {
        return $this->belongsTo(Contact::class,'contact_id');
    }
    public function schedules() {
        return $this->belongsToMany(Schedule::class,'schedules_users','user_id','work_schedule_id')->withTimestamps();
        
    }
    public function hasAnyRole($roles)
    {
        if (is_array($roles)) {
            foreach ($roles as $role) {
                if ($this->hasRole($role)) {
                    return true;
                }
            }
        } else {
            if ($this->hasRole($roles)) {
                return true;
            }
        }
        return false;
    }
    
    public function hasRole($role)
    {
        if ($this->roles()->where('name', $role)->first()) {
            return true;
        }
        return false;
    }


  


}
