<x-layouts.user>
    <div class="uk-margin-large-top uk-container">
        <div class="uk-hidden@m uk-margin-xlarge-top"></div>

        <ul class="uk-breadcrumb uk-margin-top">
            <li><a href="{{route('homepage')}}">Home</a></li>
            <li><a href="{{route('genres.index')}}">Genres</a></li>
            <li>
                <a
                    href="{{route('genres.show', ['genre'=> strtolower($movie->genre->name)])}}">{{$movie->genre->name}}</a>
            </li>
            <li><span>{{$movie->title}}</span></li>
        </ul>


        <h1>
            {{$movie->title}}
        </h1>
        {{-- <x-movie.thumbnail :movie="$movie" :overlay="false"></x-movie.thumbnail> --}}



        @if(Str::startsWith($movie->video, 'yt:'))
        <iframe class="uk-margin-bottom" id="movie"
            src="https://www.youtube-nocookie.com/embed/{{Str::substr($movie->video, 3)}}?autoplay=1&rel=0&modestbranding=1&playsinline=0"
            width="1920" height="1080" allowfullscreen uk-responsive></iframe>
        @endif

    </div>

</x-layouts.user>
