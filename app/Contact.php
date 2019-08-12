<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use User;

class Contact extends Model
{
   
    protected $table='contact_data';
    protected $fillable = [
        'street','number', 'flat_number','postal_code','city','country','phone_number','user_id'

    ];
    public function users() {
        return $this->hasOne(User::class,'contact_id');
        
    }

}
