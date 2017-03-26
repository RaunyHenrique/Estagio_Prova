@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel">
                    <div class="panel-heading"><h4>Editar: {{$pessoa->name}}</h4></div>
                    <hr>
                    <div class="panel-body">
                        <a id="voltar" type="button" class="btn btn-primary" href="{{route('pessoa')}}">
                            <i class="fa fa-arrow-left" aria-hidden="true"></i>
                            Voltar
                        </a>
                        <br>
                        <br>

                        <!-- Válidações -->
                        @include('partials._validacao')

                        {!! Form::open(['route'=>['pessoa.update', $pessoa->id], 'method'=>'put', 'id'=>'formEditar']) !!}
                        <div class="form-group">
                            {!! Form::label('name', 'Nome:') !!}
                            {!! Form::text('name', $pessoa->name, ['class'=>'form-control', 'required' => 'required']) !!}
                        </div>

                        <div class="form-group">
                            {!! Form::label('email', 'Email:') !!}
                            {!! Form::text('email', $pessoa->email, ['class'=>'form-control', 'required' => 'required']) !!}
                        </div>

                        <div class="form-group col-md-6 col-sm-6 col-xs-6 aux">
                            {!! Form::label('estado', 'Estado:') !!}
                            <select id="estadoId" class="form-control" name="estado" required>

                                <?php
                                //Helper para distribuir todos estados por regiões
                                $regioes = \App\Helpers\Helper::regioes($estados);
                                ?>

                                <optgroup label="Norte">
                                    @foreach($regioes[0] as $estado)
                                        @if($pessoa->cidade->estadoCidade->id == $estado->id)
                                            <option selected value="{{$estado->id}}">{{$estado->nome}}</option>
                                        @else
                                            <option value="{{$estado->id}}">{{$estado->nome}}</option>
                                        @endif
                                    @endforeach
                                </optgroup>

                                <optgroup label="Nordeste">
                                    @foreach($regioes[1] as $estado)
                                        @if($pessoa->cidade->estadoCidade->id == $estado->id)
                                            <option selected value="{{$estado->id}}">{{$estado->nome}}</option>
                                        @else
                                            <option value="{{$estado->id}}">{{$estado->nome}}</option>
                                        @endif
                                    @endforeach
                                </optgroup>

                                <optgroup label="Centro-Oeste">
                                    @foreach($regioes[2] as $estado)
                                        @if($pessoa->cidade->estadoCidade->id == $estado->id)
                                            <option selected value="{{$estado->id}}">{{$estado->nome}}</option>
                                        @else
                                            <option value="{{$estado->id}}">{{$estado->nome}}</option>
                                        @endif
                                    @endforeach
                                </optgroup>

                                <optgroup label="Sudeste">
                                    @foreach($regioes[3] as $estado)
                                        @if($pessoa->cidade->estadoCidade->id == $estado->id)
                                            <option selected value="{{$estado->id}}">{{$estado->nome}}</option>
                                        @else
                                            <option value="{{$estado->id}}">{{$estado->nome}}</option>
                                        @endif
                                    @endforeach
                                </optgroup>

                                <optgroup label="Sul">
                                    @foreach($regioes[4] as $estado)
                                        @if($pessoa->cidade->estadoCidade->id == $estado->id)
                                            <option selected value="{{$estado->id}}">{{$estado->nome}}</option>
                                        @else
                                            <option value="{{$estado->id}}">{{$estado->nome}}</option>
                                        @endif
                                    @endforeach
                                </optgroup>

                            </select>
                        </div>

                        <div class="form-group col-md-6 col-sm-6 col-xs-6 aux aux2">
                            {!! Form::label('cidade_id', 'Cidade:') !!}
                            <input id="pcidade_id" type="hidden" value="{{$pessoa->cidade->id}}">
                            <select required id="cidade_id" class="form-control" name="cidade_id">
                                <option selected value=""></option>
                            </select>
                        </div>

                        <div class="form-group">
                            {!! Form::label('hobbie', 'Hobbies:') !!}
                            <!-- Caso continue com erro.. verificar todos seletec... e colocar no vetor e em um hidden -->
                            <select required id="hobbies" class="form-control" name="hobbies[]" multiple="multiple">
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
                            <button type="submit" class="btn btn-success btnsalvar">
                                <i class='fa fa-check' aria-hidden='true'></i>
                            Atualizar</button>
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
        //Populando select's de cidade e estados, quando a pagina é carrefada
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
                        //Ajusta a cidade, caso já tenha sido escolhida antes
                        $('#cidade_id').append('<option selected value="'+v.id+'">'+v.nome+'</option>');
                    }
                    else {
                        $('#cidade_id').append('<option value="'+v.id+'">'+v.nome+'</option>');
                    }
                })
            });
        });

        //Populando select's de cidade e estados dinamicamente, quando se seleciona outra cidade(onchange)
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
            $("select").select2({
                width: '100%'
            });
        });

    </script>

@endsection