<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model {
    protected $table = 'articles';

    protected $fillable = [
        'name', 'description', 'points', 'price', 'status', 'is_active', 'image'
    ];

    public function category() {
        return $this->belongsTo('App\Category');
    }

    public function user() {
        return $this->belongsTo('App\User');
    }

    public function interchange() {
        return $this->belongsTo('App\Interchange');
    }

    function scopeSearch($query, $arg) {
        return $query->where('description','LIKE','%'.$arg.'%')->orWhere('name','LIKE','%'.$arg.'%');
    }
}
