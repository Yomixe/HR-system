<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use User;
use Illuminate\Database\Eloquent\SoftDeletes;
class Contact extends Model
{
    use SoftDeletes;
    protected $table='contact_data';
    protected $fillable = [
        'street','number', 'flat_number','postal_code','city','country','phone_number','user_id'

    ];
    public function users() {
        return $this->hasOne(User::class,'contact_id');
        
    }

}
