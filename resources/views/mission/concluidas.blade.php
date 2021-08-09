@extends('layouts.home')

@section('content')
<style>
.pagination li.active {
    background-color: #8B64EC;
}
</style>
    <div class="container-default">
        <div class="row">
            <h3 class="col-9 menu-title"><i class="fas fa-check-circle icon-title"></i>Missões concluídas</h3>
        </div>
        <div class="row">
            <div class="col s12 np">
                <div class="card darken-1">
                    <table class="highlight centered missions_list">
                        <tbody>
                            @if ($my_missions->isEmpty())
                                <b class="text-center my-5 grey-text h4">Nenhuma missão sfsfds</b>
                            @endif
                            @foreach ($my_missions as $mission)
                                @if ($mission->level_mission == null || $mission->level_mission == Auth::user()->level)
                                    <tr id="tr-{{ $mission->id }}">
                                        <th style="padding:9px 20px !important">
                                            <span id="mission_name-{{ $mission->id }}"
                                                class="mission_name">{{ $mission->name }}</span>
                                        </th>
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @if ($my_missions->lastPage() > 1)
                    <ul class="pagination" style="display:flex;justify-content:flex-end">
                        <li class="{{ $my_missions->currentPage() == 1 ? ' disabled' : '' }}">
                            <a href="{{ $my_missions->url(1) }}">Anterior</a>
                        </li>
                        @for ($i = 1; $i <= $my_missions->lastPage(); $i++)
                            <li class="{{ $my_missions->currentPage() == $i ? ' active' : '' }}">
                                <a href="{{ $my_missions->url($i) }}">{{ $i }}</a>
                            </li>
                        @endfor
                        <li
                            class="{{ $my_missions->currentPage() == $my_missions->lastPage() ? ' disabled' : '' }}">
                            <a href="{{ $my_missions->url($my_missions->currentPage() + 1) }}">Próximo</a>
                        </li>
                    </ul>
                @endif
            </div>
        </div>
    </div>
    @include('layouts.modal-missions')
    @include('layouts.toastr-message')
@endsection

@section('scripts')
    <script>
    </script>
@endsection
