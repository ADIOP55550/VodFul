<x-layouts.user>
    <div style="scroll-snap-type: y mandatory;">

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

            <div class="uk-inline uk-margin-bottom">
                @if(Auth::user()->favourites->movies->contains($movie))
                <form method="POST" action="{{route('movie.unfav', ['id'=>$movie->hashid()])}}">
                    @csrf
                    <button class="uk-button uk-button-default" type="submit">Remove from my favourites
                    </button>
                </form>
                @else
                <form method="POST" action="{{route('movie.fav', ['id'=>$movie->hashid()])}}">
                    @csrf
                    <button class="uk-button uk-button-default" type="submit"> Add to my favourites
                    </button>
                </form>
                @endif
            </div>

            <p class="uk-margin-bottom uk-width-medium">
                {{$movie->description}}
            </p>

        </div>

        <div class="uk-section uk-section-secondary" style="scroll-snap-align: center;">
            @if(Str::startsWith($movie->video, 'yt:'))
            <iframe class="uk-margin-bottom uk-height-viewport uk-width-1-1" id="movie"
                src="https://www.youtube-nocookie.com/embed/{{Str::substr($movie->video, 3)}}?autoplay=1&rel=0&modestbranding=1&playsinline=0"
                allowfullscreen uk-responsive></iframe>
            @endif
            <script>
                document.addEventListener("DOMContentLoaded", ()=>{
                document.querySelector('#movie').scrollIntoView();
            });
            </script>
        </div>
    </div>

</x-layouts.user>
