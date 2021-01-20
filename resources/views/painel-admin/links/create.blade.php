@extends('template.template-admin')
@section('title', 'Cadastro de Clientes')
@section('content')
<h6 class="mb-4"><i>CADASTRO DE CLIENTES</i></h6><hr>
<form method="POST" action="{{route('links.insert')}}">
    @csrf
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label for="exampleInputEmail1">Titulo</label>
                <input type="text" class="form-control" name="title" Placeholder="Digite o Titulo" required>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="exampleInputEmail1">Link</label>
                <input type="text" class="form-control" name="link" Placeholder="Digite o link de redirecionamento." required>
            </div >
            <div align="right">
                <button  type="submit" class="btn btn-primary">Salvar</button>
            </div>
            
        </div>
    </div>
   
</form>
@endsection