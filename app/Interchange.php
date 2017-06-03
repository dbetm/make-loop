<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Interchange extends Model {
    protected $table  'interchanges';

    public function article() { //Revisar relación entre artículo e intercambio
        return $this->hasOne('App\Article');
    }

    public function users() {
       return $this->belongsToMany('App\User');
    }
}
