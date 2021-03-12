@extends('template.template-admin')
@section('title', 'Editar Link')
@section('content')
<h6 class="mb-4"><i> EDITAR LINK</i></h6>
<hr>
<form id="form" method="POST" action="{{route('links.editar', $item)}}">
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
        <button id="btn-salvar" type="submit" class="btn btn-primary">Salvar</button>
    </div>
</form>

<div id="confirm" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background-color:#ffd5d3">
                <h5 class="modal-title" style="color:#930701">Atenção !</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" style="color:#930701">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Você está alterando um link de redirencionamento. <br>
                Caso seja uma correção na URL continue <br>
                Se estiver trocando essa página por uma nova: Exclua esse registro e insira um novo. <br>
                Na dúvida entre em contato com a equipe de desenvolvimento.
            </div>
            <div class="modal-footer">
            <div class="row">
                <b class="text-left">Deseja continuar?</b>
                <div class="float-right">
                    <button onclick="confirmed()" type="button" class="btn btn-primary">Continuar</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                </div>
            </div>
            </div>
        </div>
    </div>
</div>

<script>
    $("#btn-salvar").click(function(e) {
        event.preventDefault();
        var valorAtual = $("[name = 'link']").val();

        var valorOriginal = <?php

                            use App\Models\Link;

                            $linkAux = Link::find($item->id);
                            echo json_encode($linkAux->link);
                            ?>;

        if (valorAtual != valorOriginal) {
            $("#confirm").modal();
        } else {
            confirmed();
        }
    });

    function confirmed() {
        $('#form').submit();
    }
</script>
@endsection