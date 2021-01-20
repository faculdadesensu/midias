@extends('template.template-admin')
@section('title', 'Editar Usuário')
@section('content')
<h6 class="mb-4"><i> EDITAR CLIENTE</i></h6><hr>
<form method="POST" action="{{route('users.editar', $item)}}">
    @csrf
    @method('put')
    <div class="row">
        <div class="col-md-3">
            <div class="form-group">
                <label for="exampleInputEmail1">Nome</label>
                <input value="{{$item->name}}" type="text" class="form-control" id="name" name="name" required>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3">
            <div class="form-group">
                <label for="exampleInputEmail1">Usuário</label>
                <input value="{{$item->username}}" type="text" class="form-control" name="username">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3">
            <div class="form-group">
                <label for="exampleInputEmail1">E-mail</label>
                <input value="{{$item->email}}" type="email" class="form-control" name="email">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3">
            <div class="form-group">
                <label for="exampleInputEmail1">Senha</label>
                <input value="{{$item->password}}" type="text" class="form-control" name="password">
            </div>
        </div>
    </div>
    <input value="{{$item->username}}" type="hidden" name="oldUsername">
    <button type="submit" class="btn btn-primary">Salvar</button>
</form>
@endsection