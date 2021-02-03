@extends('template.template-admin')
@section('title', 'Lista de Ignorados')
@section('content')

<link href="{{ URL::asset('vendor/datatables/buttons.bootstrap4.min.css') }}" rel="stylesheet">

<script src="{{ URL::asset('vendor/datatables/dataTables.buttons.min.js') }}"></script>
<script src="{{ URL::asset('vendor/datatables/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ URL::asset('vendor/datatables/jszip.min.js') }}"></script>
<script src="{{ URL::asset('vendor/datatables/buttons.html5.min.js') }}"></script>
<script src="{{ URL::asset('vendor/datatables/buttons.print.min.js') }}"></script>
<script src="{{ URL::asset('vendor/datatables/moment.min.js') }}"></script>
<script src="{{ URL::asset('vendor/datatables/datetime-moment.js') }}"></script>

<?php
@session_start();
if (@$_SESSION['level'] != 'admin') {
  echo "<script language='javascript'> window.location='./' </script>";
}
if (!isset($id)) {
  $id = "";
}
?>

<div class="card shadow mb-4">
  <div class="card-body">
  <div class="table-responsive">
    <table id="dataTable" class="table table-bordered" width="100%" cellspacing="0">
        <thead>
            <tr>
              <th>Nome</th>
              <th>ID</th>
              <th>Usuário</th>
              <th>E-mail</th>
              <th>Ações</th>
            </tr>
        </thead>
        <tbody>
        @for($i=0; $i < count($results); $i++) 
          <tr>
              <td>{{$results[$i]->firstname}} {{$results[$i]->lastname}}</td>
              <td>{{$results[$i]->id_user}}</td>
              <td>{{$results[$i]->username}}</td>
              <td>{{$results[$i]->email}} </td>
              <td>
                <form action="{{route('moodle.delete', $results[$i]->id)}}" method="post">
                  @csrf
                  @method('delete')
                  <button title="Adicionar na lista" class="btn btn-primary" type="submit">Excluir</button>  
                </form>
            </td>
          </tr>
        @endfor
        </tbody>
    </table>
  </div>
</div>
</div>   

@endsection