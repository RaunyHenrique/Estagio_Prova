@extends('layouts.app')

@section('css')
    <link href="{{ asset('css/dataTables.bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/buttons.dataTables.min.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel">
                    <div class="panel-heading"><h4>Lista de Pessoas</h4></div>
                    <hr>
                    <div class="panel-body">

                        <a id="cadastrar" data-toggle="modal" data-target="#modalCadastro"
                           type="button" class="btn btn-success">
                            <i class="fa fa-plus" aria-hidden="true"></i>
                            Cadastrar pessoa
                        </a>
                        <br>
                        <br>

                        <!-- Table -->
                        @include('partials._table_pessoas')

                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal de cadastro -->
    @include('partials._modal')

@endsection

@section('script')
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        //Datatable
        $(document).ready(function() {
            $('#tabela').DataTable( {
                "language": {
                    "lengthMenu": "Mostrando _MENU_ registros por página",
                    "zeroRecords": "Nada encontrado",
                    "info": "Mostrando página _PAGE_ de _PAGES_",
                    "infoEmpty": "Nenhum registro disponível",
                    "infoFiltered": "(Filtrando de _MAX_ registros no total)"
                }
            } );

        } );

        //Select2
        $(document).ready(function() {
            $("select").select2({
                placeholder: "Selecione..."
            });

            $(".selectModal").select2({
                placeholder: "Selecione...",
                width: '100%'
            });
        });

        //Populando select's de cidades e estados dinamicamente
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

    </script>

    <!-- Validação Ajax -->
    @include('vendor.lrgt.ajax_script', ['form' => '#formCadastrar',
    'request'=>'App/Http/Requests/PessoaRequest','on_start'=>true])
@endsection

