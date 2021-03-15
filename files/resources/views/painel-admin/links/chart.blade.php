@extends('template.template-admin')
@section('title', 'Administrador')
@section('content')
<?php

use App\Models\AccessLink;
use App\Models\Link;
use Carbon\Carbon;
?>

<script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="card-title">Acompanhamento de Acesso</div>
                <hr>
                <div class="row">
                    <div class="col-4" style="border-right: 1px solid rgba(0,0,0,.1);">
                        <div class="form-group">
                            <label>Links</label>
                            <?php
                            $links = Link::where('inactive', '=', 0)->get();
                            $count = 0;
                            ?>
                            @foreach($links as $link)
                            <div class="form-check">
                                <input class="form-check-input" type="radio" value="{{$link->id}}" name="links" id="radioLink-{{$link->id}}" <?php if ($count == 0) echo ('checked'); ?>>
                                <label class="form-check-label" for="radioLink-{{$link->id}}">{{$link->title}}</label>
                            </div>
                            <?php $count++; ?>
                            @endforeach
                        </div>
                    </div>
                    <div class="col-8">
                        <p>Inputs do período</p>
                        <div class="row">
                            <div class="col-4">
                                <div class="form-group">
                                    <?php
                                    $dataInicial = new Carbon('today');
                                    $dataInicial = $dataInicial->modify('-7 day')->format('Y-m-d');
                                    ?>
                                    <label>Data Inicial</label>
                                    <input class="form-control form-control-sm" type="date" value="<?php echo $dataInicial ?>" id="data-inicial">
                                </div>
                            </div>
                            <div class="offset-2 col-4">
                                <div class="form-group">
                                    <label>Data Final</label>
                                    <input class="form-control form-control-sm" type="date" value="<?php echo date('Y-m-d') ?>" id="data-final">
                                </div>
                            </div>
                        </div>
                        <div id="chart-container">
                            <canvas id="qtdAcessoDia" min-height="200px"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    listaDatas =
        <?php
        $qtdDiasConsulta = 7;
        // Define o período do relatório.
        $dataInicial = new Carbon('today');
        $dataFinal = new Carbon('today');

        $dataInicial = $dataInicial->modify('- '  . $qtdDiasConsulta . ' day');

        // Cria uma lista e a preenche com todos os meses dentro desse período.
        $listaDatas = [];
        for ($dataAux = $dataInicial; $dataAux->format('d/m/Y') != $dataFinal->format('d/m/Y');) {
            $dataAux = $dataAux->modify('+1 day');
            array_push($listaDatas, $dataAux->format('d/m/Y'));
        }

        echo (json_encode($listaDatas));
        ?>;

    listaAcessos =
        <?php

        // Define o período do relatório.
        $dataInicial = new Carbon('first day of this month');
        $dataInicial = $dataInicial->modify('-' . $qtdDiasConsulta . ' month')->format('Y-m-d');
        $dataFinal = date('Y-m-d');

        $acessos = AccessLink::whereBetween('date', [$dataInicial, $dataFinal])->get();

        $listaAcessos = [];
        foreach ($acessos as $acesso) {
            $date = date_format(date_create($acesso->date), 'd/m/Y');

            $link = Link::find($acesso->id_link);
            if (!isset($listaAcessos[$link->title])) {
                $listaAcessos[$link->title] = $listaDatas;
            }

            $index = array_search($date, $listaAcessos[$link->title]);
            $listaAcessos[$link->title][$index] = $acesso->count;
        }

        echo (json_encode($listaAcessos));
        ?>;
    let listaDataSets = [];
    var listaCores = ['#ff1c1c', '#ff6b1c', '#ffbb1c', '#b0ff1c', '#49ff1c', '#1cffac', '#1ce8ff', '#1c7eff', '#241cff', '#ce1cff', '#ff1cc2', '#ff1c2f']

    var count = 0;
    for (var i in listaAcessos) {
        for (var j in listaAcessos[i]) {

            if (typeof listaAcessos[i][j] == "string") {
                if (listaAcessos[i][j].indexOf("/") !== -1) {
                    listaAcessos[i][j] = 0;
                }
            }
        }

        listaDataSets.push({
            fill: false,
            label: i,
            data: listaAcessos[i],
            lineTension: 0.5,
            backgroundColor: listaCores[count],
            borderColor: listaCores[count]
        });
        count++;
    }

    $(document).ready(function() {
        // Cria o gráfico com os dados desejados
        var ctx = document.getElementById('qtdAcessoDia').getContext('2d');
        var qtdAcessoDia = new Chart(ctx, {
            type: 'line',
            data: {
                labels: listaDatas,
                datasets: listaDataSets,
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            suggestedMin: 0,
                            stepSize: 1
                        },
                    }]
                }
            }
        });
    });

    function updateChart(chart) {
        chart.update();
    }
</script>
@endsection