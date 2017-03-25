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
        $pessoa = Pessoa::create($input);

        //Atualizando os hobbies
        $auxinp = $input['hobbies'];
        foreach ($auxinp as $value){
            $idhobbie = (int)$value;
            $pessoa->hobbiesPessoa()->attach($idhobbie);
        }


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
        $pessoa->hobbiesPessoa()->attach($aux);

        //var_dump($hobbies);

        return redirect()->route('pessoa');
    }

    public function edit($id){
        $pessoa = Pessoa::find($id);
        $estados = Estado::all();
        $hobbies = Hobbie::all();

        return view('pessoas.edit', compact('pessoa', 'estados', 'hobbies'));
    }

    public function destroy($id){
        //Desvincula todos os hobbies e deleta
        Pessoa::find($id)->hobbiesPessoa()->detach();
        Pessoa::destroy($id);

        return redirect()->route('pessoa');
    }

    public function update(PessoaRequest $request, $id){
        $input = $request->all();

        $pessoa= Pessoa::find($id);
        $pessoa->update($input);

        //Atualizando os hobbies
        $auxinp = $input['hobbies'];
        foreach ($auxinp as $value){
            $idhobbie = (int)$value;
            $pessoa->hobbiesPessoa()->attach($idhobbie);
        }


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
        $pessoa->hobbiesPessoa()->attach($aux);

        //var_dump($aux);


        //$pessoa->hobbiesPessoa()->detach(); //em todos...


        return redirect()->route('pessoa');
    }
}
