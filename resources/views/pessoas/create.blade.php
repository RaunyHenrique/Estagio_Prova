@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Cadastrar pessoa</div>

                    <div class="panel-body">
                        <a href="{{route('pessoa')}}" class="btn btn-default">Voltar</a>
                        <br>
                        <br>

                        @if($errors->any())
                            <ul class="alert alert-warning">
                                @foreach($errors->all() as $error)
                                    <li>{{$error}}</li>
                                @endforeach
                            </ul>
                        @endif

                        {!! Form::open(['route'=>'pessoa.store']) !!}
                            <div class="form-group">
                                {!! Form::label('name', 'Nome:') !!}
                                {!! Form::text('name', null, ['class'=>'form-control']) !!}
                            </div>

                            <div class="form-group">
                                {!! Form::label('email', 'Email:') !!}
                                {!! Form::text('email', null, ['class'=>'form-control']) !!}
                            </div>

                            <div class="form-group">
                                {!! Form::label('estado', 'Estado:') !!}
                                <select id="estadoId" class="form-control input-sm" name="estado">
                                    {{$count = 0}}
                                    @foreach($estados as $estado)
                                        @if($count == 0)
                                            <option value=""></option>
                                            {{$count++}}
                                        @endif
                                        <option value="{{$estado->id}}">{{$estado->nome}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                {!! Form::label('cidade_id', 'Cidade:') !!}
                                <select id="cidade_id" class="form-control input-sm" name="cidade_id">
                                    <option value=""></option>
                                </select>
                            </div>

                            <div class="form-group">
                                {!! Form::label('hobbie', 'Hobbies:') !!}
                                <select id="hobbies" class="form-control input-sm" name="hobbies">
                                    @foreach($hobbies as $hobbie)
                                        <option value="{{$hobbie->id}}">{{$hobbie->name}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                {!! Form::submit('Salvar', ['class'=>'btn btn-primary']) !!}
                            </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection