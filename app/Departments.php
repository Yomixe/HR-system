<?php

namespace App;
use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Departments extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'name','description'
    ];
    public function users() {
        return $this->hasMany(User::class,'department_id');
        
    }
   

   
}