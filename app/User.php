<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
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
     * Method one to One
     * User -> Profile
     * @return void
     */
    /* Karna satu user hanya memiliki satu profile, maka penamaan functionnya singular */
    public function profile(){
        /* Function hasone, diarahkan ke class yang ingin dimiliki oleh class User*/
        return $this->hasOne(Profile::class);
    }
    /**
     * Sebagai Model Parent dari POST, dan menggunakan penamaan plurals, karna satu user bisa memiliki banyak post
     * Method One to Many
     * User -> POST
     * @return void
     */
    public function posts(){
        return $this->hasMany(Post::class);
    }
}
