@extends('template.template-admin')
@section('title', 'Editar Link')
@section('content')
<h6 class="mb-4"><i> EDITAR LINK</i></h6><hr>
<form method="POST" action="{{route('links.editar', $item)}}">
    @csrf
    @method('put')
    <div class="row">
        <div class="col-md-5">
            <div class="form-group">
                <label for="exampleInputEmail1">Título</label>
                <input value="{{$item->title}}" type="text" class="form-control" name="title" placeholder="Digite o Título" required>
            </div>
        </div>
        <div class="col-md-7">
            <div class="form-group">
                <label for="exampleInputEmail1">Link</label>
                <input value="{{$item->link}}" type="text" class="form-control" name="link" placeholder="Digite o link de redirecionamento." required>
            </div>
        </div>
    </div>
    <div class="float-right">
        <input value="{{$item->link}}" type="hidden" name="oldLink">
        <button type="submit" class="btn btn-primary">Salvar</button>
    </div>

</form>
@endsection