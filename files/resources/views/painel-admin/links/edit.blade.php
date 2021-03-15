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
                <label>Título</label>
                <input value="{{$item->title}}" type="text" class="form-control" name="title" placeholder="Digite o Título" required>
            </div>
        </div>
        <div class="col-md-7">
            <div class="form-group">
                <label>Link</label>
                <input value="{{$item->link}}" type="text" class="form-control" name="link" placeholder="Digite o link de redirecionamento." required>
            </div>
        </div>
    </div>
    <div class="float-right">
        <button id="btn-salvar" type="submit" class="btn btn-primary">Salvar</button>
    </div>
</form>

<!-- Modal de Confirmação -->
<div id="confirm" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header-danger">
                <h5 class="modal-title">Atenção!</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h5>Você está alterando um link de redirecionamento!</h5>
                <hr>
                <p>Caso seja apenas uma <b>correção na URL:</b> Continue.</p>
                <p>Se você deseja <b>trocar essa URL por outro motivo:</b> Exclua esse registro e insira um novo.</p>
                <div style="font-size: 12px;">Em caso de dúvida entre em contato com a equipe de desenvolvimento.</div>
            </div>
            <div class="modal-footer-custom">
                <b>Deseja continuar?</b>
                <div class="float-right">
                    <button onclick="confirmed()" type="button" class="btn btn-danger">Continuar</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Verifica se o link foi alterado.
    $("#btn-salvar").click(function(e) {
        e.preventDefault();
        var valorAtual = $("[name = 'link']").val();

        var valorOriginal =
            <?php
            use App\Models\Link;

            $linkAux = Link::find($item->id);
            echo json_encode($linkAux->link);
            ?>;

        // Solicita a confirmação da ação.
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