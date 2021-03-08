@extends('template.template-admin')
@section('title', 'Links')
@section('content')
<?php
@session_start();
if (@$_SESSION['level'] != 'admin' && @$_SESSION['level'] != 'user') {
  echo "<script language='javascript'> window.location='./' </script>";
}
if (!isset($id)) {
  $id = "";
}
?>

<style>
  tr {
    cursor: pointer;
  }
</style>

<link href="{{ URL::asset('vendor/datatables/rowReorder.dataTables.min.css') }}" rel="stylesheet" type="text/css">
<script src="{{ URL::asset('vendor/datatables/dataTables.rowReorder.min.js') }}?{{$version}}"></script>

<a href="{{route('links.inserir')}}" type="button" class="mt-4 mb-4 btn btn-primary">Novo</a>
<button id="reordenar" title="Selecione um link e o arraste para ordenar-lo." class="mt-4 mb-4 btn btn-primary" disabled>Reordenar</button>

<meta name="csrf-token" content="{{ csrf_token() }}">

<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered" id="tableOrderable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th hidden>index</th>
            <th hidden>id</th>
            <th>Título</th>
            <th>Link</th>
            <th>Ações</th>
          </tr>
        </thead>
        <tbody>
          @foreach($links as $item)
          <tr>
            <td class="selectable" hidden>{{$item->index}}</td>
            <td class="selectable" hidden>{{$item->id}}</td>
            <td class="selectable">{{$item->title}}</td>
            <td class="selectable">{{$item->link}}</td>
            <td>
              <a href="{{route('links.edit', $item)}}"><i class="fas fa-edit text-info mr-1"></i></a>
              <a title="Deletar conteúdo" href="{{route('links.modal', $item->id)}}"><i class="fas fa-trash text-danger mr-1"></i></a>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Deletar Registro</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Deseja Realmente Excluir este Registro?
      </div>
      <div class="modal-footer">
        <a href="{{route('links.index')}}" type="button" class="mt-4 mb-4 btn btn-secondary">Cancelar</a>
        <form method="POST" action="{{route('links.delete', $id)}}">
          @csrf
          @method('delete')
          <button type="submit" class="btn btn-danger">Excluir</button>
        </form>
      </div>
    </div>
  </div>
</div>

<script>
  // Configuração tabela datatable
  var table = "";
  $(document).ready(function() {
    table = $('#tableOrderable').DataTable({
      paging: false,
      rowReorder: {
        selector: 'td.selectable'
      },
      columnDefs: [{
          name: "index",
          targets: 0,
          visible: false,
        },
        {
          name: "id",
          targets: 1,
          visible: false,
          orderable: false
        },
        {
          name: "titulo",
          targets: 2,
          orderable: false
        },
        {
          name: "link",
          targets: 3,
          orderable: false
        },
        {
          name: "acao",
          targets: 4,
          orderable: false
        }
      ],
      initComplete: function(settings, json) {
        $("#reordenar").prop("disabled", false);
      }
    });
  });

  // Submit da função reordenar (feito com AJAX)
  $('#reordenar').click(function(e) {
    e.preventDefault();

    var rowData = [];

    var count = table.rows().count();
    for (let index = 0; index < count; index++) {
      var data = table.rows().data()[index];
      rowData.push(data);
    }

    jQuery.ajax({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      url: "{{ route('links.reorder') }}",
      method: 'post',
      data: {
        data: rowData,
      },
      dataType: 'JSON',
      beforeSend: function() {
        startLoadding('reordenar');
      },
      success: function(result) {
        alertMsg(result.status, result.msg);
        stopLoadding('reordenar');
      }
    });
  });
</script>

<?php
if (@$id != "") {
  echo "<script>$('#exampleModal').modal('show');</script>";
}
?>
@endsection