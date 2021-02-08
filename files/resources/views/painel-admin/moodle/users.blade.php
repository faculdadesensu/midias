@extends('template.template-admin')
@section('title', 'Lista de usuários')
@section('content')

<link href="{{ URL::asset('vendor/datatables/buttons.bootstrap4.min.css') }}" rel="stylesheet">

<script src="{{ URL::asset('vendor/datatables/dataTables.buttons.min.js') }}?{{$version}}"></script>
<script src="{{ URL::asset('vendor/datatables/buttons.bootstrap4.min.js') }}?{{$version}}"></script>
<script src="{{ URL::asset('vendor/datatables/jszip.min.js') }}?{{$version}}"></script>
<script src="{{ URL::asset('vendor/datatables/buttons.html5.min.js') }}?{{$version}}"></script>
<script src="{{ URL::asset('vendor/datatables/buttons.print.min.js') }}?{{$version}}"></script>
<script src="{{ URL::asset('vendor/datatables/moment.min.js') }}?{{$version}}"></script>
<script src="{{ URL::asset('vendor/datatables/datetime-moment.js') }}?{{$version}}"></script>

<?php
@session_start();
if (@$_SESSION['level'] != 'admin') {
  echo "<script language='javascript'> window.location='./' </script>";
}
if (!isset($id)) {
  $id = "";
}
?>
<h2 class="mb-4"><i>Lista de usuários cadastrados no Moodle {{$moodle}}</i></h2>
<a href="{{ route('moodle.ignorados')}}" type="button" class="mb-3 btn btn-primary">Voltar para lista</a>
<div class="card shadow mb-4">
  <div class="card-body">
    <div class="table-responsive">
      <table id="dataTable_users" class="table table-bordered" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>Nome</th>
            <th>Usuário</th>
            <th>E-mail</th>
            <th>Ações</th>
          </tr>
        </thead>
      </table>
    </div>
  </div>
</div>

<script type="text/javascript">
  $(document).ready(function() {

    var route = "";
    if ("{{$moodle}}" === "A") {
      route = "{{ route('moodle.listA') }}"
    } else if ("{{$moodle}}" === "B") {
      route = "{{ route('moodle.listB') }}"
    }

    var dataTable = $('#dataTable_users').DataTable({
      "responsive": true,
      "processing": true,
      "serverSide": true,
      "autoWidth": true,
      "ajax": {
        url: route,
        error: function(data) {
          alert("Erro desconhecido!");
        },
      },
      "language": {
        "search": "Buscar:",
        "lengthMenu": "Mostrar _MENU_ Registros",
        "zeroRecords": "Nenhum registro encontrado",
        "info": "Mostrar _PAGE_ de _PAGES_ de _TOTAL_ Registros",
        "infoEmpty": "Nenhum registro disponível",
        "infoFiltered": "(filtrando de _MAX_ resultados)",
        "loadingRecords": "Carregando...",
        "processing": "Processando...",
        "paginate": {
          "next": "Próxima",
          "previous": "Anterior"
        },
      },
      "columns": [{
          "data": function(data) {
            return data.firstname + " " + data.lastname;
          },
          "name": "nome",
        },
        {
          "data": "username",
          "name": "username",
        },
        {
          "data": "email",
          "name": "email",
        },
        {
          "data": function(data) {
            return '<form action="{{route("moodle.add")}}" method="get">@csrf<input type="hidden" name="user_id" value="' + data.id + '"><input type="hidden" name="username" value="' + data.username + '"><input type="hidden" name="firstname" value="' + data.firstname + '"><input type="hidden" name="lastname" value="' + data.lastname + '"><input type="hidden" name="email" value="' + data.email + '"><input type="hidden" name="moodle" value="{{$moodle}}"><button title="Adicionar na lista"  class="btn btn-primary" type="submit">Adicionar</button></form>';
          },
          "name": "acoes",
        }
      ],
      "initComplete": function() {
        var input = $('.dataTables_filter input').unbind();
        self = this.api();

        // Realiza a pesquisa sempre que pressionado Enter dentro do input de pesquisa. 
        $('.dataTables_filter input').keyup(function(e) {
          if (e.keyCode == 13) {
            self.search($(this).val()).draw();
          }
        });

        // Cria o botão de pesquisa com a função respectiva.
        $searchButton = $('<button class="btn btn-sm btn-primary ml-2" style="margin-top: -1px;"><i class="fas fa-search">').click(function() {
          self.search(input.val()).draw();
        });

        // Adiciona o botão de pesquisa ao filtro da tabela 
        $('.dataTables_filter').append($searchButton);
      },
    });
  });
</script>

@endsection