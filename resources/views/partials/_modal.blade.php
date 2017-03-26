<div class="modal fade" id="modalCadastro"
     tabindex="-1" role="dialog"
     aria-labelledby="favoritesModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close"
                        data-dismiss="modal"
                        aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"
                    id="favoritesModalLabel">Cadastrar pessoa</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">

                        <!-- Válidações -->
                        @include('partials._validacao')

                        {!! Form::open(['route'=>'pessoa.store', 'id'=>'formCadastrar']) !!}
                        <div class="form-group">
                            {!! Form::label('name', 'Nome:') !!}
                            {!! Form::text('name', null, ['class'=>'form-control', 'id'=>'name', 'required' => 'required']) !!}
                        </div>

                        <div class="form-group">
                            {!! Form::label('email', 'Email:') !!}
                            {!! Form::text('email', null, ['class'=>'form-control', 'required' => 'required']) !!}
                        </div>

                        <div class="form-group col-md-6 col-sm-6 col-xs-6 aux">
                            {!! Form::label('estado', 'Estado:') !!}
                            <select required id="estadoId" class="form-control selectModal" name="estado">

                                <option value=""></option>

                                <?php
                                    //Helper para distribuir todos estados por regiões
                                    $regioes = \App\Helpers\Helper::regioes($estados);
                                ?>

                                <optgroup label="Norte">
                                    @foreach($regioes[0] as $estado)
                                        <option value="{{$estado->id}}">{{$estado->nome}}</option>
                                    @endforeach
                                </optgroup>

                                <optgroup label="Nordeste">
                                    @foreach($regioes[1] as $estado)
                                        <option value="{{$estado->id}}">{{$estado->nome}}</option>
                                    @endforeach
                                </optgroup>

                                <optgroup label="Centro-Oeste">
                                    @foreach($regioes[2] as $estado)
                                        <option value="{{$estado->id}}">{{$estado->nome}}</option>
                                    @endforeach
                                </optgroup>

                                <optgroup label="Sudeste">
                                    @foreach($regioes[3] as $estado)
                                        <option value="{{$estado->id}}">{{$estado->nome}}</option>
                                    @endforeach
                                </optgroup>

                                <optgroup label="Sul">
                                    @foreach($regioes[4] as $estado)
                                        <option value="{{$estado->id}}">{{$estado->nome}}</option>
                                    @endforeach
                                </optgroup>

                            </select>
                        </div>

                        <div class="form-group col-md-6 col-sm-6 col-xs-6 aux aux2">
                            {!! Form::label('cidade_id', 'Cidade:') !!}
                            <select required id="cidade_id" class="form-control selectModal" name="cidade_id">
                                <option value=""></option>
                            </select>
                        </div>


                        <div class="form-group">
                            {!! Form::label('hobbies', 'Hobbies:') !!}
                            <select required id="hobbies" class="form-control selectModal" name="hobbies[]" multiple="multiple">
                                @foreach($hobbies as $hobbie)
                                    <option value="{{$hobbie->id}}">{{$hobbie->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button"
                        class="btn btn-danger btnbold" data-dismiss="modal">
                    <i class="fa fa-times" aria-hidden="true"></i>
                    Cancelar
                </button>
                <span class="pull-right btndir">
                        <div class="form-group">
                            <button type="submit" class="btn btn-success btnbold">
                                <i class='fa fa-check' aria-hidden='true'></i>
                            Salvar
                            </button>
                        </div>
                </span>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>