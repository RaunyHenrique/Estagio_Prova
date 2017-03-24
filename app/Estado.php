<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Estado extends Model
{
    public function cidadeEstado(){
        return $this->hasMany('App\Cidade', 'estado');
    }
}
