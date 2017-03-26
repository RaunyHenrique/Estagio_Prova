<div class="table-responsive">
    <table id="tabela" class="table table-striped table-bordered table-hover">
        <thead>
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Email</th>
            <th>Cidade</th>
            <th>Estado</th>
            <th>Hobbies</th>
            <th class="text-center">Ação</th>
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
                <td class="text-center">
                    <div class="btn-group">
                        <a type="button" href="{{route('pessoa.edit', ['id'=>$pessoa->id])}}"
                           class="btn btn-default"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                            Editar</a>
                        <a type="button" onclick="return confirm('Você tem certeza que deseja deletar {{$pessoa->name}}?');"
                           href="{{route('pessoa.destroy', ['id'=>$pessoa->id])}}" class="btn btn-danger">
                            <i class="fa fa-times" aria-hidden="true"></i>
                            Deletar</a>
                        <div>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>