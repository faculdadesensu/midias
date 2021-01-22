@extends('template.template-admin')
@section('title', 'Bloqueio e Desbloqueio Moodle')
@section('content')

<link href="{{ URL::asset('vendor/datatables/buttons.bootstrap4.min.css') }}" rel="stylesheet">

<script src="{{ URL::asset('vendor/datatables/dataTables.buttons.min.js') }}"></script>
<script src="{{ URL::asset('vendor/datatables/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ URL::asset('vendor/datatables/jszip.min.js') }}"></script>
<script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="{{ URL::asset('vendor/datatables/buttons.html5.min.js') }}"></script>
<script src="{{ URL::asset('vendor/datatables/buttons.print.min.js') }}"></script>

<?php
@session_start();
if (@$_SESSION['level'] != 'admin') {
  echo "<script language='javascript'> window.location='./' </script>";
}
if (!isset($id)) {
  $id = "";
}
?>

<div class="container-fluid">
  <div class="card shadow mb-4">
    <div class="card-body">
      <div class="row">
        <div class="col-md-6 d-flex justify-content-center">
          <a type="button" href="{{route('moodle.lock')}}" class="btn btn-sm btn-primary">Bloquear Professores</a>
        </div>
        <div class="col-md-6 d-flex justify-content-center">
          <a type="button" href="{{route('moodle.unlock')}}" class="btn btn-sm btn-primary">Desbloquear Professores</a>
        </div>
      </div>
      <hr>

      <br>
      <div class="row">
        <div class="col-12" id="position-buttons">
        </div>
      </div>
      <br>

      <div class="row">
        <div class="col-12">
          <div class="table-responsive">
            <table id="results-table" class="table table-bordered" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>Usuário</th>
                  <th>Nome</th>
                  <th>E-mail</th>
                  <th>Operação realizada</th>
                  <th>Hora do bloqueio/desbloqueio</th>
                  <th>Instituição</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>username</td>
                  <td>firstname</td>
                  <td>email </td>
                  <td>userid</td>
                  <td>time</td>
                  <td>institution</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  var table = $('#results-table').DataTable({
    responsive: true,
    ordering: false,
    buttons: [{
        extend: 'excel',
        text: 'Excel',
        className: 'btn-sm',
      },
      {
        extend: 'pdf',
        text: 'Pdf',
        className: 'btn-sm',
      },
      {
        extend: 'print',
        text: 'Imprimir',
        className: 'btn-sm',
      },
    ],
    language: {
      search: "Buscar:",
      lengthMenu: "Mostrar _MENU_ Registros",
      zeroRecords: "Nenhum registro encontrado",
      info: "Mostrar _PAGE_ de _PAGES_ de _TOTAL_ Registros",
      infoEmpty: "Nenhum registro disponível",
      infoFiltered: "(filtrando de _MAX_ resultados)",
      loadingRecords: "Carregando...",
      processing: "Processando...",
      paginate: {
        next: "Próxima",
        previous: "Anterior"
      },
    }
  });
  table.buttons().containers().appendTo('#position-buttons');
</script>

@endsection