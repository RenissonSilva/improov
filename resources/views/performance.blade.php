@extends('layouts.home')

@section('content')
<style>

</style>
    <div class="container-default">
        <div class="row">
            <h3 class="col-12 menu-title"><i class="fas fa-chart-line icon-title"></i>Análise de desempenho</h3>
        </div>

        <div class="row">
            <div class="col-md-4">
                <div class="card-panel grey lighten-5 z-depth-1 card-margin-default card-performance d-flex align-items-center justify-content-center">
                    <div>
                        <div class="d-flex justify-content-center">
                            <div class="circle responsive-img repo-language circle-performance justify-content-center valign-wrapper">
                                <i class="fas fa-fire icon-performance" style="color: #46C86B;"></i>
                            </div>
                        </div>
                        <p class="text-center mb-0 mt-2 name-chart">22</p>
                        <p class="text-center value-chart">Dias em foco</p>
                    </div>
                </div>
            </div>

            <div class="col-md-8">
                <div class="card-panel grey lighten-5 z-depth-1 card-margin-default card-performance d-flex align-items-center justify-content-center">
                    <div>
                        <div class="d-flex justify-content-center">
                            <!-- <div class="circle responsive-img repo-language circle-performance justify-content-center valign-wrapper">
                                <i class="fas fa-fire icon-performance" style="color: #46C86B;"></i>
                            </div> -->
                        </div>
                        <!-- <p class="text-center mb-0 mt-2 name-chart">22</p> -->
                        <p class="text-center value-chart">Frequência de commits</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-8">
                <div class="card-panel grey lighten-5 z-depth-1 card-margin-default card-performance d-flex align-items-center justify-content-center">
                    <div>
                        <div class="d-flex justify-content-center">
                            <!-- <div class="circle responsive-img repo-language circle-performance justify-content-center valign-wrapper">
                                <i class="fas fa-fire icon-performance" style="color: #46C86B;"></i>
                            </div> -->
                        </div>
                        <!-- <p class="text-center mb-0 mt-2 name-chart">22</p> -->
                        <p class="text-center value-chart">Posição do ranking</p>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card-panel grey lighten-5 z-depth-1 card-margin-default card-performance d-flex align-items-center justify-content-center" style="border-left: 6px solid #FF4242">
                    <div>
                        <div class="d-flex justify-content-center">
                            <div class="circle responsive-img repo-language circle-performance justify-content-center valign-wrapper" style="border: 5px solid #FF4242;">
                                <i class="fas fa-check icon-performance" style="color: #FF4242;"></i>
                            </div>
                        </div>
                        <p class="text-center mb-0 mt-2 name-chart">0</p>
                        <p class="text-center value-chart">Missões concluídas</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4">
                <div class="card-panel grey lighten-5 z-depth-1 card-margin-default card-performance d-flex align-items-center justify-content-center">
                    <div>
                        <div class="d-flex justify-content-center">
                            <div class="circle responsive-img repo-language circle-performance justify-content-center valign-wrapper" style="min-width:80px;border: 5px solid #46C86B;">
                                <i class="far fa-folder icon-performance" style="color: #46C86B;"></i>
                            </div>
                        </div>
                        <p class="text-center mb-0 mt-2 name-chart">31</p>
                        <p class="text-center value-chart">Repositórios criados</p>
                    </div>
                </div>
            </div>

            <div class="col-md-8">
                <div class="card-panel grey lighten-5 z-depth-1 card-margin-default card-performance d-flex align-items-center justify-content-center">
                    <div>
                        <div class="d-flex justify-content-center">
                            <!-- <div class="circle responsive-img repo-language circle-performance justify-content-center valign-wrapper">
                                <i class="fas fa-fire icon-performance" style="color: #46C86B;"></i>
                            </div> -->
                        </div>
                        <!-- <p class="text-center mb-0 mt-2 name-chart">22</p> -->
                        <p class="text-center value-chart">Linguagem dos projetos</p>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection

@section('scripts')
<script></script>
@endsection
