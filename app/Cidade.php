<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cidade extends Model
{
    protected $fillable = ['nome', 'estado'];

    public function estadoCidade(){
        return $this->belongsTo('App\Estado', 'estado');
    }

    public function pessoa(){
        return $this->hasMany('App\Pessoa');
    }
}
