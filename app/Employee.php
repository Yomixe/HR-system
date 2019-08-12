<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Employee extends Model
{
   

    protected $table='employment_data';
    protected $fillable = [
        'start_job_date',
        'salary',
        'working_hours',
        'tax_office',
        'health_exam_from',
        'health_exam_to',
        'position',
      
    ];
    public function users() {
        return $this->hasOne(User::class,'employee_id');
        
    }
}
