@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Lista de Pessoas</div>

                <div class="panel-body">
                    <a href="{{route('pessoa.create')}}" class="btn btn-success">Cadastrar pessoa</a>
                    <br>
                    <br>
                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nome</th>
                            <th>Email</th>
                            <th>Cidade</th>
                            <th>Estado</th>
                            <th>Hobbies</th>
                            <th>Ação</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($pessoas as $pessoa)
                            <tr>
                                <td>{{ $pessoa->id }}</td>
                                <td>{{ $pessoa->name }}</td>
                                <td>{{ $pessoa->email }}</td>
                                <td>{{ $pessoa->cidade->nome }}</td>
                                <td>{{ $pessoa->cidade->estadoCidade->nome }}</td>
                                <td>
                                    @foreach($pessoa->hobbiesPessoa as $hobbie)
                                        <span class='label label-primary'>{{$hobbie->name}}</span>
                                    @endforeach
                                </td>
                                <td>
                                    <a href="{{route('pessoa.edit', ['id'=>$pessoa->id])}}" class="btn btn-default">Editar</a>
                                    <a href="{{route('pessoa.destroy', ['id'=>$pessoa->id])}}" class="btn btn-danger">Deletar</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection