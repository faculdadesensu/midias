@extends('template.template-admin')
@section('title', 'Editar Usuário')
@section('content')
<h6 class="mb-4"><i> EDITAR CLIENTE</i></h6><hr>
<form method="POST" action="{{route('links.editar', $item)}}">
    @csrf
    @method('put')
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label for="exampleInputEmail1">Titulo</label>
                <input value="{{$item->title}}" type="text" class="form-control" name="title" required>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="exampleInputEmail1">Link</label>
                <input value="{{$item->link}}" type="text" class="form-control" name="link">
            </div>
        </div>
    </div>
    <div align="right">
        <input value="{{$item->link}}" type="hidden" name="oldLink">
        <button type="submit" class="btn btn-primary">Atualizar</button>
    </div>
    
</form>
@endsection