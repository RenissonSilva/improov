@extends('layouts.home')

@section('content')
<style>

</style>
    <div class="container-default">
        <div class="row">
            <h3 class="col-12 menu-title"><i class="fas fa-chart-line icon-title"></i>Análise de desempenho</h3>
        </div>

        <div class="row range-date-tab d-flex align-items-center justify-content-center" id="range-menu">
            <span class="item-range-menu d-flex align-items-center justify-content-center btn-performance-range" data-value="1">Diário</span>
            <span class="item-range-menu d-flex align-items-center justify-content-center btn-performance-range" data-value="7">Semanal</span>
            <span class="item-range-menu d-flex align-items-center justify-content-center btn-performance-range" data-value="30">Mensal</span>
            <span class="item-range-menu d-flex align-items-center justify-content-center btn-performance-range focus-button" data-value="36500">Todos</span>
        </div>

        <div class="row ">
            <div class="row pl-3 valign-wrapper" style="margin-left: initial;">
                <div class="legend-square green"></div><span class="green-text fw-500 legend-style">Ideal</span>
                <div class="legend-square red"></div><span class="red-text fw-500 legend-style">Abaixo do ideal</span>
            </div>
    
            <div id="loading-circle" class="hide" style="margin-right: 15px;">
                <div class="preloader-wrapper small active">
                    <div class="spinner-layer spinner-green-only">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div><div class="gap-patch">
                        <div class="circle"></div>
                    </div><div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4">
                <div class="card-panel grey lighten-5 z-depth-1 card-margin-default card-{{ $color_focus }} d-flex align-items-center justify-content-center">
                    <div>
                        <div class="d-flex justify-content-center">
                            <div class="circle responsive-img repo-language circle-{{ $color_focus }} justify-content-center valign-wrapper icon-{{ $color_focus }}">
                                <i class="fas fa-fire icon-performance icon-{{ $color_focus }}"></i>
                            </div>
                        </div>
                        <p class="text-center mb-0 mt-2 name-chart">{{ Auth::user()->focus_days }}</p>
                        <p class="text-center value-chart">Dias em foco</p>
                    </div>
                </div>
            </div>

            <div class="col-md-8">
                <div class="card-panel grey lighten-5 z-depth-1 card-margin-default card-{{ $color_commits }} d-flex align-items-center justify-content-center">
                    <div style="width: -webkit-fill-available; height: auto;">
                        <div class="d-flex justify-content-center">
                            <canvas id="chartCommits"></canvas>
                            <progress id="animationProgress" max="1" value="0" style="width: 100%"></progress>
                            <span id="spanChartCommits" class="hide spanChart">Sem dados suficientes para gerar o gráfico</span>
                        </div>
                        <p class="text-center value-chart">Frequência de commits</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-8">
                <div class="card-panel grey lighten-5 z-depth-1 card-margin-default card-{{ $color_mainLanguages }} d-flex align-items-center justify-content-center">
                    <div style="width: -webkit-fill-available; height: auto;">
                        <div class="d-flex justify-content-center">
                            <canvas id="chartProjectsTech"></canvas>
                            <span id="spanChartProjectsTech" class="hide spanChart">Sem dados suficientes para gerar o gráfico</span>
                        </div>
                        <p class="text-center value-chart">Linguagem dos projetos</p>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card-panel grey lighten-5 z-depth-1 card-margin-default card-{{ $color_countOfRepo }} d-flex align-items-center justify-content-center">
                    <div>
                        <div class="d-flex justify-content-center">
                            <div class="circle responsive-img repo-language circle-{{ $color_countOfRepo }} justify-content-center valign-wrapper">
                                <i class="far fa-folder icon-performance icon-{{ $color_countOfRepo }}" ></i>
                            </div>
                        </div>
                        <p class="text-center mb-0 mt-2 name-chart" id="countOfRepo">{{ $countOfRepo }}</p>
                        <p class="text-center value-chart">Repositórios criados</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- <div class="col-md-8">
                <div class="card-panel grey lighten-5 z-depth-1 card-margin-default card-performance d-flex align-items-center justify-content-center">
                    <div>
                        <div class="d-flex justify-content-center">

                        </div>
                        <p class="text-center value-chart">Posição do ranking</p>
                    </div>
                </div>
            </div> -->

            <div class="col-md-4">
                <div class="card-panel grey lighten-5 z-depth-1 card-margin-default card-{{ $color_completedMissions }} d-flex align-items-center justify-content-center card-{{ $color_completedMissions }}">
                    <div>
                        <div class="d-flex justify-content-center">
                            <div class="circle responsive-img repo-language circle-{{ $color_completedMissions }} justify-content-center valign-wrapper">
                                <i class="fas fa-check icon-performance icon-{{ $color_completedMissions }}"></i>
                            </div>
                        </div>
                        <p class="text-center mb-0 mt-2 name-chart" id="completedMissions">{{ $completedMissions }}</p>
                        <p class="text-center value-chart">Missões concluídas</p>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection

@section('scripts')
<script>
const ctxCommit = document.getElementById('chartCommits').getContext('2d');
const commits = {!! json_encode($commits) !!};
const labels_commit = commits.map((x) => x.date);
const count_of_commits = commits.map((x) => x.count);

let chartCommits = new Chart(ctxCommit, {
    type: 'line',
    data: {
        labels: labels_commit,
        datasets: [{
            data: count_of_commits,
            backgroundColor: [
                'rgba(43, 166, 125)',
            ],
            borderColor:[
                'rgba(43, 166, 125, 0.8)',
            ],
            hoverOffset: 4
        }]
    },
    options: {
        elements: {
            bar: {
                // borderWidth: 2,
            }
        },
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: {
                display: false,
            },
        },
        scales: {
            x: {
                grid: {
                    display: false
                }
            },
            y: {
                grid: {
                    display: false
                }
            }
        },
    }
});
    
const ctx = document.getElementById('chartProjectsTech').getContext('2d');
const data = {!! json_encode($main_languages) !!};
const labels = data.map((x) => x.main_language);
const count_of_projects = data.map((x) => x.count);

let chartProjectsTech = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: labels,
        datasets: [{
            data: count_of_projects,
            backgroundColor: [
                'rgba(43, 166, 125)',
                'rgba(72, 35, 166)',
                'rgba(61, 45, 64)',
                'rgba(46, 80, 179)',
                'rgba(217, 169, 46)',
            ],
            hoverOffset: 4
        }]
    },
    options: {
        indexAxis: 'y',
        elements: {
            bar: {
                // borderWidth: 2,
            }
        },
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: {
                display: false,
            },
        },
        scales: {
            x: {
                grid: {
                    display: false
                }
            },
            y: {
                grid: {
                    display: false
                }
            }
        },
    }
});

$(".btn-performance-range").click(function () {
    $("#loading-circle").removeClass('hide');
    $("#range-menu").addClass('disable-menu');
    $(".item-range-menu").css("pointer-events", "none");
    $('.focus-button').removeClass('focus-button');
    $(this).addClass('focus-button');
    period = this.dataset.value

    $.ajax({
        url: "{{ route('performance') }}",
        method:'GET',
        dataType: 'json',
        data: { period: period, json: true },
        success: function (res) {
            $('#countOfRepo').text(res.countOfRepo);
            $('#completedMissions').text(res.completedMissions);
            let commits = res.commits;
            let labels_commit = commits.map((x) => x.date);
            let count_of_commits = commits.map((x) => x.count);
            let main_languages = res.main_languages;
            let labels = main_languages.map((x) => x.main_language);
            let count_of_projects = main_languages.map((x) => x.count);

            if(count_of_commits.length === 0) {
                $("#spanChartCommits").removeClass("hide");
            } else {
                $("#spanChartCommits").addClass("hide");
            }

            if(count_of_projects.length === 0) {
                $("#spanChartProjectsTech").removeClass("hide");
            } else {
                $("#spanChartProjectsTech").addClass("hide");
            }
            chartCommits.data.datasets.data = count_of_commits;
            chartCommits.data.labels = labels_commit;
            chartCommits.update();

            chartProjectsTech.data.datasets.data = count_of_projects;
            chartProjectsTech.data.labels = labels;
            chartProjectsTech.update();
        },
    });
    setTimeout(
        function() 
        {
            $("#range-menu").removeClass('disable-menu');
            $("#loading-circle").addClass('hide');
            $(".item-range-menu").css("pointer-events", "auto");
        }, 1000);
    })
</script>
@endsection
