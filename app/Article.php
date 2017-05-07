<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model {
    protected $table = 'articles';

    protected $fillable = [
        'name', 'description', 'city', 'points', 'shipping_way', 'price',
        'status', 'image'
    ];

    public function category() {
        return $this->belongsTo('App\Category');
    }

    public function user() {
        return $this->belongsTo('App\User');
    }
}
