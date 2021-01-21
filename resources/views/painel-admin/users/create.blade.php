@extends('template.template-admin')
@section('title', 'Cadastro de Usuários')
@section('content')
<h6 class="mb-4"><i>CADASTRO DE USUÁRIOS</i></h6>
<hr>
<form method="POST" action="{{route('users.insert')}}">
    @csrf
    <div class="row">
        <div class="col-md-3">
            <div class="form-group">
                <label for="exampleInputEmail1">Nome</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Digite seu nome" required>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="exampleInputEmail1">Usuário</label>
                <input type="text" class="form-control" name="username" placeholder="Ex: administrador" required>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="exampleInputEmail1">E-mail</label>
                <input type="email" class="form-control" name="email" placeholder="Ex: exemplo@faculdadesensu.edu.br" required>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="exampleInputEmail1">Senha</label>
                <input type="password" class="form-control" name="password" placeholder="Digite a Senha" required>
            </div>
        </div>
    </div>
    <div class="float-right">
        <button type="submit" class="btn btn-primary">Salvar</button>
    </div>

</form>
@endsection