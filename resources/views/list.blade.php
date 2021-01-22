@extends('layouts.home')

@section('content')

    @foreach($github_repo as $repo)
        <p class="text-center"><a href="{{$repo->html_url}}" target="_blank">{{$repo->name}}</a></p>
    @endforeach

@endsection
