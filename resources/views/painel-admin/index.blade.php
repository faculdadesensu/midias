@extends('template.template-admin')
@section('title', 'Administrador')
@section('content')
<?php 
@session_start();

if(@$_SESSION['level'] != 'admin' && @$_SESSION['level'] != 'user' ){ 
  echo "<script language='javascript'> window.location='./' </script>";
}

?>
<div class="card col-lg-4 col-md-8 col-sm-12 embed-responsive embed-responsive-1by1">
  <iframe src="{{url('https://conteudo.faculdadesensu.edu.br/9-dicas-para-o-enem')}}">Your browser isn't compatible</iframe>
</div>

@endsection