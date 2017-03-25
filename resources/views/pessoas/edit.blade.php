@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Editar pessoa: {{$pessoa->name}}</div>

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

                        {!! Form::open(['route'=>['pessoa.update', $pessoa->id], 'method'=>'put']) !!}
                        <div class="form-group">
                            {!! Form::label('name', 'Nome:') !!}
                            {!! Form::text('name', $pessoa->name, ['class'=>'form-control']) !!}
                        </div>

                        <div class="form-group">
                            {!! Form::label('email', 'Email:') !!}
                            {!! Form::text('email', $pessoa->email, ['class'=>'form-control']) !!}
                        </div>

                        <div class="form-group">
                            {!! Form::label('estado', 'Estado:') !!}
                            <select id="estadoId" class="form-control input-sm" name="estado">

                                {{--<option value="{{$pessoa->cidade->estadoCidade->id}}">--}}
                                    {{--{{$pessoa->cidade->estadoCidade->nome}}--}}
                                {{--</option>--}}

                                <?php
                                //Dessa maneira, se diminui o numero de
                                //iterações sobre o vetor estados
                                $c1 = 0;
                                $r1 = [];
                                $c2 = 0;
                                $r2 = [];
                                $c3 = 0;
                                $r3 = [];
                                $c4 = 0;
                                $r4 = [];
                                $c5 = 0;
                                $r5 = [];
                                foreach ($estados as $estado){
                                    if($estado->regiao == 1){
                                        $r1[$c1] = $estado;
                                        $c1++;
                                    }
                                    elseif($estado->regiao == 2){
                                        $r2[$c2] = $estado;
                                        $c2++;
                                    }
                                    elseif($estado->regiao == 3){
                                        $r3[$c3] = $estado;
                                        $c3++;
                                    }
                                    elseif($estado->regiao == 4){
                                        $r4[$c4] = $estado;
                                        $c4++;
                                    }
                                    elseif($estado->regiao == 5){
                                        $r5[$c5] = $estado;
                                        $c5++;
                                    }
                                }
                                ?>

                                <optgroup label="Norte">
                                    @foreach($r1 as $estado)
                                        @if($pessoa->cidade->estadoCidade->id == $estado->id)
                                            <option selected value="{{$estado->id}}">{{$estado->nome}}</option>
                                        @else
                                            <option value="{{$estado->id}}">{{$estado->nome}}</option>
                                        @endif
                                    @endforeach
                                </optgroup>

                                <optgroup label="Nordeste">
                                    @foreach($r2 as $estado)
                                        @if($pessoa->cidade->estadoCidade->id == $estado->id)
                                            <option selected value="{{$estado->id}}">{{$estado->nome}}</option>
                                        @else
                                            <option value="{{$estado->id}}">{{$estado->nome}}</option>
                                        @endif
                                    @endforeach
                                </optgroup>

                                <optgroup label="Centro-Oeste">
                                    @foreach($r3 as $estado)
                                        @if($pessoa->cidade->estadoCidade->id == $estado->id)
                                            <option selected value="{{$estado->id}}">{{$estado->nome}}</option>
                                        @else
                                            <option value="{{$estado->id}}">{{$estado->nome}}</option>
                                        @endif
                                    @endforeach
                                </optgroup>

                                <optgroup label="Sudeste">
                                    @foreach($r4 as $estado)
                                        @if($pessoa->cidade->estadoCidade->id == $estado->id)
                                            <option selected value="{{$estado->id}}">{{$estado->nome}}</option>
                                        @else
                                            <option value="{{$estado->id}}">{{$estado->nome}}</option>
                                        @endif
                                    @endforeach
                                </optgroup>

                                <optgroup label="Sul">
                                    @foreach($r5 as $estado)
                                        @if($pessoa->cidade->estadoCidade->id == $estado->id)
                                            <option selected value="{{$estado->id}}">{{$estado->nome}}</option>
                                        @else
                                            <option value="{{$estado->id}}">{{$estado->nome}}</option>
                                        @endif
                                    @endforeach
                                </optgroup>

                            </select>
                        </div>

                        <div class="form-group">
                            {!! Form::label('cidade_id', 'Cidade:') !!}
                            <input id="pcidade_id" type="hidden" value="{{$pessoa->cidade->id}}">
                            <select id="cidade_id" class="form-control input-sm" name="cidade_id">
                                <option selected value=""></option>
                            </select>
                        </div>

                        <div class="form-group">
                            {!! Form::label('hobbie', 'Hobbies:') !!}
                            <select id="hobbies" class="form-control input-sm" name="hobbies[]" multiple="multiple">
                                @foreach($hobbies as $hobbie)
                                    {{$flag = false}}
                                    @foreach($pessoa->hobbiesPessoa as $value)
                                        @if($value->id == $hobbie->id)
                                            {{$flag = true}}
                                        @endif
                                    @endforeach
                                    @if($flag)
                                        <option selected value="{{$hobbie->id}}">{{$hobbie->name}}</option>
                                    @else
                                        <option value="{{$hobbie->id}}">{{$hobbie->name}}</option>
                                    @endif
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

@section('script')
    <script>
        //Populando select's de cidade e estados
        $(document).ready(function() {
            var estadoId = document.getElementById('estadoId').value;
            var pcidade_id = document.getElementById('pcidade_id').value;

            $('#cidade_id').empty();

            //Envia uma solicitação get via ajax, com o id do estado, que é tratada na
            //rota. Com objetivo de filtrar o select das cidades
            $.get('/ajax-cidade?estado_id='+estadoId, function (data) {
                //Itera cada posição do json recebido, e adiciona corretamente ao
                //select das cidades
                $.each(data, function (k, v) {
                    if(v.id == pcidade_id){
                        $('#cidade_id').append('<option selected value="'+v.id+'">'+v.nome+'</option>');
                    }
                    else {
                        $('#cidade_id').append('<option value="'+v.id+'">'+v.nome+'</option>');
                    }
                })
            });
        });

        //Populando select's de cidade e estados dinamicamente
        $('#estadoId').on('change', function() {
            var estadoId = this.value;
            $('#cidade_id').empty();
            //Envia uma solicitação get via ajax, com o id do estado, que é tratada na
            //rota. Com objetivo de filtrar o select das cidades
            $.get('/ajax-cidade?estado_id='+estadoId, function (data) {
                //Itera cada posição do json recebido, e adiciona corretamente ao
                //select das cidades
                $.each(data, function (k, v) {
                    $('#cidade_id').append('<option value="'+v.id+'">'+v.nome+'</option>');
                })
            });
        });

        //Select2
        $(document).ready(function() {
            $("select").select2();
            $("#hobbies").select2();//editar....multiselect
        });

    </script>
@endsection