@extends('layouts.app')

@section('css')
    <link href="{{ asset('css/dataTables.bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/jquery-confirm.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel">
                    <div class="panel-heading"><h4>Lista de Pessoas</h4></div>
                    <hr>
                    <div class="panel-body">
                        <a class="helpdiv" style="display: none"></a>
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

    <script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('js/dataTables.bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/jquery-confirm.js') }}"></script>

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

        //Deletar
        function conf(link) {

            $.confirm({
                title: 'Deletar',
                content: 'Você tem certeza que deseja deletar?',
                buttons: {
                    cancelar: function () {

                    },
                    confirm: function () {
                        //Para poder usar o jquery-confirm
                        $('.helpdiv').prop('href', link);
                        $('.helpdiv')[0].click();
                    }
                }
            });
        };

    </script>
@endsection

