@extends('layouts.main')

@section('main')
    <div class="uk-margin-large-top uk-container">
                <div class="uk-hidden@m uk-margin-xlarge-top"></div>

        <ul class="uk-breadcrumb uk-margin-top">
            <li><a href="{{route('homepage')}}">Home</a></li>
            <li><a href="{{route('genres.index')}}">Genres</a></li>
            <li>
                <a href="{{route('genres.show', ['genre'=> strtolower($movie->genre->name)])}}">{{$movie->genre->name}}</a>
            </li>
            <li><span>{{$movie->title}}</span></li>
        </ul>


        <h1>
            Movie: {{$movie->title}} #{{$movie->hashid()}}
        </h1>
        <x-movie.thumbnail :movie="$movie" :overlay="false"></x-movie.thumbnail>

        {{-- --}}
    </div>

@endsection
