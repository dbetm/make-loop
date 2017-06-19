<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'last_name', 'email', 'password', 'bio', 'is_active'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function articles() {
        return $this->hasMany('App\Article');
    }

    public function interchange() {
        return $this->hasOne('App\Interchange');
    }
    //Search for users, by their id or email
    function scopeSearch($query, $arg) {
        return $query->where('id',$arg)->orWhere('email','LIKE','%'.$arg.'%');
    }
}
