@extends('layouts.home')

@section('content')
    <table>
    @foreach($github_repo as $repo)
    <tr>
        <td><a href="{{$repo->html_url}}" target="_blank">{{$repo->name}}</a></td>
    </tr>
    @endforeach
    </table>
@endsection
