<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Interchange extends Model {
    protected $table = 'interchanges';

    protected $fillable = ['status'];

    public function article() {
        return $this->belongsTo('App\Article');
    }

    public function user() {
       return $this->belongsTo('App\User');
    }
}
