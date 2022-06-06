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
            Movie: {{$movie->title}} #{{$movie->hashid()}}
        </h1>
        <x-movie.thumbnail :movie="$movie" :overlay="false"></x-movie.thumbnail>

        <iframe width="560" height="315" src="https://www.youtube.com/embed/djV11Xbc914" title="YouTube video player"
            frameborder="0"
            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
            allowfullscreen></iframe>

    </div>

</x-layouts.user>
