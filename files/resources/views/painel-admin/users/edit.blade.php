@extends('template.template-admin')
@section('title', 'Editar Usuário')
@section('content')
<h6 class="mb-4"><i> EDITAR USUÁRIO</i></h6>
<hr>
<form method="POST" action="{{route('users.editar', $item)}}">
    @csrf
    @method('put')
    <div class="row">
        <div class="col-md-3">
            <div class="form-group">
                <label for="exampleInputEmail1">Nome</label>
                <input value="{{$item->name}}" type="text" class="form-control" placeholder="Digite seu nome" id="name" name="name" required>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="exampleInputEmail1">Usuário</label>
                <input value="{{$item->username}}" type="text" class="form-control" placeholder="Ex: administrador" name="username" required>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="exampleInputEmail1">E-mail</label>
                <input value="{{$item->email}}" type="email" class="form-control" placeholder="Ex: exemplo@faculdadesensu.edu.br" name="email" required>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="exampleInputEmail1">Senha</label>
                <input value="{{$item->password}}" type="password" class="form-control" placeholder="Digite a Senha" name="password">
            </div>
        </div>
    </div>
    <div class="float-right">
        <input value="{{$item->username}}" type="hidden" name="oldUsername">
        <button type="submit" class="btn btn-primary">Salvar</button>
    </div>
</form>
@endsection