@extends('layouts.home')

@section('content')
<div class="container">
    <div class="row">
        <h3 class="col-9 menu-title"><i class="fas fa-check-double icon-title"></i>Missões diárias</h3>
        <h3 class="col menu-title grey-text text-darken-1 right-align">1/2</h3>
    </div>
    <table class="striped">
        <tbody>
            @foreach($my_missions as $mission)
            <tr class="row">
                <td class="col-8 mission-text">{{$mission}}</td>
                <td class="col valign-wrapper">
                    <div class="progress">
                        <div class="determinate" style="width: 70%;"></div>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
      </table>
</div>
@endsection
