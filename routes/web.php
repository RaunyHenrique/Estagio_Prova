<?php

use Illuminate\Support\Facades\Input;
use App\Cidade;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', ['as'=>'pessoa', 'uses'=>'PessoasController@index']);

//Ajeitar verbos..
Route::group(['prefix'=>'pessoa', 'where'=>['id'=>'[0-9]+']], function (){
    Route::get('create', ['as'=>'pessoa.create', 'uses'=>'PessoasController@create']);
    Route::post('store', ['as'=>'pessoa.store', 'uses'=>'PessoasController@store']);
    Route::get('{id}/destroy', ['as'=>'pessoa.destroy', 'uses'=>'PessoasController@destroy']);
    Route::get('{id}/edit', ['as'=>'pessoa.edit', 'uses'=>'PessoasController@edit']);
    Route::put('{id}/update', ['as'=>'pessoa.update', 'uses'=>'PessoasController@update']);
});

Route::get('/ajax-cidade', function (){
    //Retorna todas as cidades de um estado escolhido
    $estadoId = Input::get('estado_id');
    $cidades = Cidade::where('estado', '=', $estadoId)->get();

    return Response::json($cidades);
});