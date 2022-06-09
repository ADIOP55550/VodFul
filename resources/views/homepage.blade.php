<x-layouts.user :openLogin="$openLogin ?? false" :openRegister="$openRegister ?? false">

    <div class="uk-width-1-1 uk-flex uk-background-cover" uk-parallax="bgy: -200, -500;"
        uk-height-viewport="expand:false; offset-bottom: 20" style="background-image: url('/images/hero.jpg');">
        <div class="uk-width-1-2@m uk-width-4-5@l uk-margin-auto uk-margin-auto-vertical">
            <h1 class=" uk-text-left">Jump into
                action!</h1>
            @guest
            <a href="{{route('register')}}" class="uk-button uk-button-default">Create an account!</a>
            @else
            @if(Auth::user()->subscribed() || Auth::user()->isAdmin())
            <a href="{{route('movie.show', ['movie'=>App\Models\Movie::query()->inRandomOrder()->first()->hashid()])}}"
                class="uk-button uk-button-default">Random movie!</a>
            @else
            <a href="{{route('profile.index') . '#choose-plan'}}" class="uk-button uk-button-default">Choose yor
                plan!</a>
            @endif
            @endguest
        </div>
    </div>

    <div class="uk-container uk-container-xlarge">
        <div class="uk-position-relative uk-visible-toggle uk-light uk-margin-top" tabindex="-1"
            uk-slideshow="ratio: 7:3; animation: pull; autoplay: true; autoplay-interval: 10000">

            <ul class="uk-slideshow-items" uk-height-viewport="offset-top: true; offset-bottom:30">
                @foreach (App\Models\Movie::query()->inRandomOrder()->take(6)->get() as $movie)
                <li>
                    <div
                        class="uk-position-cover uk-animation-kenburns uk-animation-reverse uk-transform-origin-center-left">
                        <img src="/images/slide0{{ $loop->index + 1 }}.jpg" alt="" uk-cover loading="lazy">
                    </div>
                    <div
                        class="uk-overlay uk-overlay-primary uk-position-bottom-left uk-position-small uk-transition-slide-bottom">
                        <h3 class="uk-margin-remove">{{$movie->title}}</h3>
                        <p class="uk-margin-remove">{{$movie->description}}</p>
                        <div class="uk-flex-row uk-margin-small-top">
                            @guest
                            <a href="{{route('login')}}"
                                class="uk-margin-small-left uk-icon-button uk-button-secondary uk-light" uk-icon="lock"
                                uk-tooltip="title:Log in to watch; pos: bottom-left; delay: 300"></a>
                            @else
                            <a href="{{route('movie.show', ['movie'=>$movie->hashid()])}}"
                                class="uk-margin-small-left uk-icon-button uk-button-secondary uk-light"
                                uk-icon="play-circle" uk-tooltip="title:Watch; pos: bottom-left; delay: 300"></a>

                            @if(Auth::hasUser() && Auth::user()->favourites->movies->contains($movie))
                            <form method="POST" class="uk-inline"
                                action="{{route('movie.unfav', ['id'=>$movie->hashid()])}}">
                                @csrf
                                <button class="uk-margin-left uk-icon-link" type="submit" uk-icon="icon: minus"
                                    uk-tooltip="Remove from favourites">
                                </button>
                            </form>
                            @else
                            <form method="POST" class="uk-inline"
                                action="{{route('movie.fav', ['id'=>$movie->hashid()])}}">
                                @csrf
                                <button class="uk-margin-left uk-icon-link" type="submit" uk-icon="icon: plus"
                                    uk-tooltip="Add to favourites">
                                </button>
                            </form>
                            @endif
                            {{-- <a href="{{route('movie.fav', ['id'=>$movie->hashid()])}}"
                                class="uk-margin-left uk-icon-link" uk-icon="plus"
                                uk-tooltip="title:Add to favoutrites; pos: bottom-left; delay: 300"></a> --}}
                            @endguest

                        </div>
                    </div>
                </li>
                @endforeach
            </ul>

            <div class="uk-position-bottom-center uk-position-small">
                <ul class="uk-slideshow-nav uk-dotnav"></ul>
            </div>
            <a class="uk-slidenav-large uk-position-center-left uk-position-medium uk-hidden-hover" href="#"
                uk-slidenav-previous uk-slideshow-item="previous"></a>
            <a class="uk-slidenav-large uk-position-center-right uk-position-medium uk-hidden-hover" href="#"
                uk-slidenav-next uk-slideshow-item="next"></a>
        </div>

        <div class="uk-container uk-container-large uk-margin-top">
            <h2>Najbardziej lubiane:</h2>
            @php
            $movies = \App\Models\Movie::query()
            ->withSum('watchedBy', 'times_watched')
            ->orderByDesc('watched_by_sum_times_watched')
            ->take(20)
            ->get();
            @endphp

            <div uk-slider>
                <div class="uk-position-relative">
                    <div class="uk-slider-container">
                        <ul class="uk-slider-items uk-grid uk-grid-gap-small">
                            @foreach ($movies as $movie)
                            <li class="uk-position-relative">
                                <x-movie.thumbnail :movie="$movie"> </x-movie.thumbnail>
                                {{-- jak usuniesz ten komentarz to PHPStorm nie lubi powyższej linijki --}}
                            </li>
                            @endforeach
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

            @if(Auth::hasUser() && (Auth::user()->subscribed() || Auth::user()->isAdmin()))

            <h2>Na podstawie tego, co oglądasz:</h2>

            @php
            $statuses = Auth::user()->watchStatuses()->with('movie','movie.genre')->get();
            $picks = [];
            if($statuses->count() > 0) {

            // get top two genre IDs (with movies watched most times)
            $top_genres = array_slice(array_keys(array_count_values(
            array_map(
            fn($m)=>$m['genre']['id'],
            array_map(
            fn($ws)=>$ws['movie'],
            Illuminate\Support\Arr::sort(
            $statuses->toArray(),
            fn($s)=>-$s['times_watched']
            )
            )
            )
            )),0,2);


            $picks = \App\Models\Movie::query()
            ->whereIn('genre_id', $top_genres)
            ->inRandomOrder()
            ->take(20)
            ->get();

            }
            @endphp

            <div uk-slider>
                <div class="uk-position-relative">
                    <div class="uk-slider-container">
                        <ul class="uk-slider-items uk-grid uk-grid-gap-small">
                            @foreach ($picks as $movie)
                            <li class="uk-position-relative">
                                <x-movie.thumbnail :movie="$movie"> </x-movie.thumbnail>
                            </li>
                            @endforeach
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
            @endif
        </div>


        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" width="640"
            height="640" viewBox="0 0 640 640" xml:space="preserve">

            <g transform="matrix(1 0 0 1 324.5 320)" id="IF9UHbaos9Cd9jlesdPkv">
                <path class="svg-elem-1"
                    d="M 79.02697 -202.19546 L 259.65340000000003 -202.19546 L 259.65340000000003 -152.41436 L 100.85163000000003 -152.41436 L 100.85163000000003 -152.41436 C 87.55996000000003 -152.41436 75.49451000000003 -144.64688999999998 69.99206000000002 -132.54764999999998 L 39.293640000000025 -65.04544999999997 L 259.56776 -65.04544999999997 L 259.56776 -21.324959999999976 L 19.813440000000014 -21.324959999999976 L -78.04651999999999 198.30758000000003 L -78.04651999999999 198.30758000000003 C -79.10906999999999 200.69233000000003 -81.48525999999998 202.21938000000003 -84.09589999999999 202.19519000000003 C -86.70653999999999 202.17101000000002 -89.05402999999998 200.60021000000003 -90.07222999999999 198.19618000000003 L -259.65341 -202.19545 L -256.27709 -202.19545 L -256.27709 -202.19545 C -224.05786999999998 -202.19545 -194.93887999999998 -182.99396 -182.24787999999998 -153.37949 L -92.26236999999998 56.60175000000001 L -92.26236999999998 56.60175000000001 C -90.84659999999998 59.90546000000001 -87.61653999999997 62.06420000000001 -84.02252999999997 62.10868000000001 C -80.42851999999998 62.15316000000001 -77.14602999999997 60.07502000000001 -75.64892999999998 56.80736000000001 C -41.79124999999998 -17.092429999999986 26.95010000000002 -167.13141 26.95010000000002 -167.13141 C 36.37983000000002 -187.71330999999998 56.53363000000002 -201.18071999999998 79.00838000000002 -202.14049999999997 z"
                    stroke-linecap="round"
                    style="stroke: rgb(0, 0, 0); stroke-width: 9; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 4; fill: none; fill-rule: nonzero; opacity: 1;"
                    transform=" translate(0, 0)" vector-effect="non-scaling-stroke">
                </path>
            </g>
        </svg>
    </div>
</x-layouts.user>
