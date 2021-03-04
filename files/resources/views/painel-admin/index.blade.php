@extends('template.template-admin')
@section('title', 'Administrador')
@section('content')
<?php 
@session_start();

if(@$_SESSION['level'] != 'admin' && @$_SESSION['level'] != 'user' ){ 
  echo "<script language='javascript'> window.location='./' </script>";
}
use App\Models\Link;
$links = link::orderby('id', 'desc')->get();
?>
<h3 class="mb-5">MONITORAMENTO DE LINKS</h3>
<div class="row ml-2">
  @foreach ($links as $item)
  <div class="mr-5 mb-5" style="box-shadow: 0 0 1em rgb(0,0,0, 0.2); border-radius: 10px">
    <div class="card" style="width:300px">
      <div class="embed-responsive embed-responsive-1by1">
        <iframe src="{{$item->link}}"></iframe>
      </div>
      <div class="card-body mr-2">
        <h4 class="card-title space-limiter">{{$item->title}}</h4>
        <a href="{{$item->link}}" class="btn btn-primary" target="_blank">Acessar Link</a>
      </div>
    </div>
  </div>
  @endforeach
</div>
@endsection