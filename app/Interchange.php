<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Interchange extends Model {
    protected $table  'interchanges';

    public function article() {
        return $this->hasOne('App\Article');
    }
}
