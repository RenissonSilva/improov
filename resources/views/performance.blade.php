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
                <div class="card-panel grey lighten-5 z-depth-1 card-margin-default" style="border-left: 6px solid #46C86B">
                    <div class="d-flex justify-content-center">
                        <div class="circle responsive-img repo-language circle-performance justify-content-center valign-wrapper" style="min-width:80px;">
                            <i class="fas fa-fire icon-performance" style="color: #46C86B;"></i>
                        </div>
                    </div>
                    <p class="text-center mb-0 mt-2" style="color:#262626;font-size: 30px;font-weight: bold;">22</p>
                    <p class="text-center" style="color:#5D5D5D;font-size: 17px;font-weight: bold;">Dias em foco</p>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script></script>
@endsection
