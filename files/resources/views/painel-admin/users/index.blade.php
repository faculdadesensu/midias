@extends('template.template-admin')
@section('title', 'Usuários')
@section('content')
<?php 
@session_start();
if(@$_SESSION['level'] != 'admin'){ 
  echo "<script language='javascript'> window.location='./' </script>";
}
if(!isset($id)){
  $id = "";
}
?>
<a href="{{route('users.inserir')}}" type="button" class="mt-4 mb-4 btn btn-primary">Novo</a>
<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
          <th>Nome</th>
          <th>Usuário</th>
          <th>E-mail</th>
          <th>Ações</th>
          </tr>
        </thead>
        <tbody>
            @foreach($users as $item)
              <tr>
                <td>{{$item->name}}</td>
                <td>{{$item->username}}</td>
                <td>{{$item->email}}</td>
                <td>
                <a href="{{route('users.edit', $item)}}"><i class="fas fa-edit text-info mr-1"></i></a>
                <a href="{{route('users.modal', $item->id)}}"><i class="fas fa-trash text-danger mr-1"></i></a>
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
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <form method="POST" action="{{route('users.delete', $id)}}">
          @csrf
          @method('delete')
          <button type="submit" class="btn btn-danger">Excluir</button>
        </form>
      </div>
    </div>
  </div>
</div>
<?php 
if(@$id != ""){
  echo "<script>$('#exampleModal').modal('show');</script>";
}
?>
@endsection


