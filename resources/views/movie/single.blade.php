<x-layouts.user>
    <div style="scroll-snap-type: y mandatory;" class="uk-light">

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
                    <button class="uk-button uk-button-primary" type="submit"> Add to my favourites
                    </button>
                </form>
                @endif
            </div>

            <p class="uk-margin-bottom uk-width-medium">
                {{$movie->description}}
            </p>

            <div class="uk-margin-bottom" id="togglable-similar-movies">
                <h2>You may also like</h2>

                @php
                $picks = [];
                $picks = \App\Models\Movie::query()
                ->where('genre_id', $movie->genre->id)
                ->inRandomOrder()
                ->take(20)
                ->get();


                @endphp

                <div uk-slider>
                    <div class="uk-position-relative">
                        <div class="uk-slider-container">
                            <ul class="uk-slider-items uk-grid uk-grid-gap-small">
                                @forelse ($picks as $mv)
                                <li class="uk-position-relative">
                                    <x-movie.thumbnail :movie="$mv"> </x-movie.thumbnail>
                                </li>
                                @empty
                                <div class="uk-placeholder uk-width-1-1 uk-height-1-1 uk-light uk-text-center">No
                                    similar movies found
                                </div>
                                @endforelse
                            </ul>
                        </div>


                        <div class="uk-hidden@s uk-light">
                            <a class="uk-position-center-left uk-position-small" href="#" uk-slidenav-previous
                                uk-slider-item="previous"></a>
                            <a class="uk-position-center-right uk-position-small" href="#" uk-slidenav-next
                                uk-slider-item="next"></a>
                        </div>

                        <div class="uk-visible@s">
                            <a class="uk-position-center-left-out uk-position-small" href="#" uk-slidenav-previous
                                uk-slider-item="previous"></a>
                            <a class="uk-position-center-right-out uk-position-small" href="#" uk-slidenav-next
                                uk-slider-item="next"></a>
                        </div>
                    </div>
                </div>
            </div>
            <a href="#togglable-similar-movies" class="uk-button uk-margin-bottom uk-button-default uk-button-small"
                uk-toggle="target: #togglable-similar-movies; animation: uk-animation-fade">Show/hide similar movies</a>
            <a class="uk-button uk-margin-bottom uk-button-default uk-button-small"
                uk-toggle="target: #movie-wrapper; cls: uk-container">change player size</a>


        </div>

        <div class="uk-section uk-section-secondary uk-padding-remove-bottom" uk-height-viewport
            style="scroll-snap-align: center;">
            <div id="movie-wrapper">
                @if(Str::startsWith($movie->video, 'yt:'))
                <iframe class="uk-width-1-1 uk-margin-auto" id="movie" uk-height-viewport
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
    </div>

</x-layouts.user>
