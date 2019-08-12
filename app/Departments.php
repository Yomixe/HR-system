<?php

namespace App;
use App\User;
use Illuminate\Database\Eloquent\Model;

class Departments extends Model
{
  
    protected $fillable = [
        'name','description'
    ];
    public function users() {
        return $this->hasMany(User::class,'department_id');
        
    }
   

   
}