<?php

namespace App\Http\Controllers;

use App\Estado;
use App\Hobbie;
use App\Http\Requests\PessoaRequest;
use App\Pessoa;
use Illuminate\Http\Request;


class PessoasController extends Controller
{
    public function index(){
        $pessoas = Pessoa::all();
        return view('pessoas.index', compact('pessoas'));
    }

    public function create(){
        $estados = Estado::all();
        $hobbies = Hobbie::all();
        return view('pessoas.create', compact('estados', 'hobbies'));
    }

    public function store(PessoaRequest $request){
        $input = $request->all();
        //vai ter varios hobbies... usar each..
        $aux = (int)$input['hobbies'];
        $hobbies = Hobbie::find($aux);

        //var_dump($hobbies);
        Pessoa::create($input)->hobbiesPessoa()->save($hobbies);

        return redirect()->route('pessoa');
    }

    public function edit($id){
        $pessoa = Pessoa::find($id);
        $estados = Estado::all();
        $hobbies = Hobbie::all();

        return view('pessoas.edit', compact('pessoa', 'estados', 'hobbies'));
    }

    //verbo delete..
    public function destroy($id){
        Pessoa::find($id)->hobbiesPessoa()->delete();
        Pessoa::destroy($id);
        return redirect()->route('pessoa');
    }

    public function update(PessoaRequest $request, $id){
        $input = $request->all();
        $aux = (int)$input['hobbies'];
        $hobbies = Hobbie::find($aux);

        $pessoa= Pessoa::find($id);

        //Para evitar hobbies repetidos
        $aux = [];
        $coun = 0;
        $flag = true;
        foreach ($pessoa->hobbiesPessoa as $hobbie){
            $flag = true;
            foreach ($aux as $v)
            {
                if ($hobbie->id == $v){
                    $flag = false;
                }
            }
            if ($flag){
                $aux[$coun] = $hobbie->id;
                $coun++;
            }
            //echo $hobbie->name;
        }
        //Disvincula os hobbies antigos
        $pessoa->hobbiesPessoa()->detach();




        //var_dump($aux);

        $pessoa->update($input);
        //$pessoa->hobbiesPessoa()->detach(); //em todos...
        //Atualiza os hobbies, sem repetição
        $pessoa->hobbiesPessoa()->attach($aux);



        return redirect()->route('pessoa');
    }
}
