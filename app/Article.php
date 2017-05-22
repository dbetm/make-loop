<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model {
    protected $table = 'articles';

    protected $fillable = [
        'name', 'description', 'points', 'price', 'status', 'image'
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
}
