<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pessoa extends Model
{
    protected $fillable = ['name', 'email', 'cidade_id'];

    public function hobbiesPessoa(){
        return $this->belongsToMany('App\Hobbie', 'pessoa_hobbie');
    }

    public function cidade(){
        return $this->belongsTo('App\Cidade');
    }
}
