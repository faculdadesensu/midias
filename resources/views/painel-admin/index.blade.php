@extends('template.template-admin')
@section('title', 'Administrador')
@section('content')
<?php 
@session_start();
if(@$_SESSION['level'] != 'admin'){ 
  echo "<script language='javascript'> window.location='./' </script>";
}
?>
Home Administrador
@endsection