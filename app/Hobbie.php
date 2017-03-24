<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hobbie extends Model
{
    public function pessoaHobbies(){
        return $this->belongsToMany('App\Pessoa', 'pessoa_hobbie');
    }
}
