<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = ['user_id', 'phone', 'address'];

    public function user(){
        /*
            Profile memiliki tempat di tabel users
        */
        return $this->belongsTo(User::class);
    }
}
