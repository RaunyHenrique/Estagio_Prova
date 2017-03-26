<?php

namespace App\Http\Controllers;

use App\Estado;
use App\Hobbie;
use App\Http\Requests\PessoaEditarRequest;
use App\Pessoa;
use App\Http\Requests\PessoaRequest;


class PessoasController extends Controller
{
    public function index(){
        $estados = Estado::all();
        $hobbies = Hobbie::all();
        $pessoas = Pessoa::orderBy('id')->get();
        return view('pessoas.index', compact('pessoas', 'estados', 'hobbies'));
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

    public function update(PessoaEditarRequest $request, $id){
        $input = $request->all();

        $pessoa= Pessoa::find($id);
        $pessoa->update($input);

        $auxinp = $input['hobbies'];
        //Desanexando hobbies antigos
        $pessoa->hobbiesPessoa()->detach();

        foreach ($auxinp as $value){
            $idhobbie = (int)$value;
            //Atualizando os hobbies
            $pessoa->hobbiesPessoa()->attach($idhobbie);
        }

        return redirect()->route('pessoa');
    }
}
