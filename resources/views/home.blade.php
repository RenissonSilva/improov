@extends('layouts.home')

@section('content')
<div class="container-default">
    <div class="row">
        <h3 class="col-9 menu-title"><i class="fas fa-check-double icon-title"></i>Missões diárias</h3>
        <h3 class="col menu-title grey-text text-darken-1 right-align">{{ $completed_missions }}/2</h3>
    </div>
    <table class="striped">
    <tbody>
        @foreach($my_missions as $mission)
        <tr class="row">
            <td class="col-8 mission-text">{{$mission}}</td>
            <td class="col valign-wrapper">
                <div class="progress">
                    @if ($loop->first)
                    <div class="determinate" style="width: {{ $progress_of_missions[0] }}%;"></div>
                    @else
                    <div class="determinate" style="width: {{ $progress_of_missions[1] }}%;"></div>
                    @endif
                </div>
            </td>
        </tr>
        @endforeach
    </tbody>
    </table>
</div>
@endsection
