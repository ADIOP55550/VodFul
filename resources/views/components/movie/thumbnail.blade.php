<div {{ $attributes->merge(['class'=>'uk-inline uk-dark uk-visible-toggle uk-animation-toggle ']) }}>
    {{-- @once
    @push('scripts')
    <script>
        function handleFavClick(ev){
            debugger;
            axios.post(ev.target.href).then(v=>{
                console.log(v);
            });
            return false;
        }
    </script>
    @endpush
    @endonce --}}


    @can('viewAny', \App\Models\Movie::class)
    <img loading="lazy" src="/images/thumbnails/movie{{Illuminate\Support\Str::padLeft($movie->id,3,'0')}}.jpg"
        style="aspect-ratio: 2/3" class="uk-height-medium" alt="">
    @if($overlay)
    <div
        class="uk-overlay-primary uk-position-cover uk-invisible-hover uk-animation-fade uk-animation-fast uk-hidden-touch">
        <div class="uk-position-top uk-height-1-1">

            <a href="
                    @guest
                        {{route('login')}}
                    @else
                        @can('watch', $movie)
                            {{route('movie.show', ['movie'=>$movie->hashid()])}}
                        @else
                            {{(route('profile.index') . '#choose-plan')}}
                        @endcan
                    @endguest
                    " class="uk-text-decoration-none">
                <div
                    class="uk-invisible-hover uk-animation-slide-top-medium uk-animation-fast uk-margin-small-top uk-padding-small uk-height-max-small">
                    {{$movie->title}}
                </div>
                @can('watch', $movie)
                <span uk-icon="icon: play-circle; ratio: 2"
                    class="uk-text-center uk-width-1-1 uk-margin-small-top"></span>
                @else
                <span uk-icon="icon: lock; ratio: 2"
                    uk-tooltip="title: @guest Log in to watch @else Choose a plan to watch @endguest;pos: bottom; delay: 200"
                    class="uk-text-center uk-width-1-1 uk-margin-small-top"></span>
                @endcan
            </a>

            <div style="pointer-events: none"
                class="uk-position-bottom uk-flex uk-flex-between uk-width-1-1 uk-margin-small-bottom uk-padding-small">
                {{-- <form method="POST" action="{{route('movie.ban', ['id'=>$movie->hashid()])}}">
                    @csrf
                    <button style="pointer-events: all" uk-icon="icon: ban" uk-tooltip="Nie interesuje mnie to">
                    </button>
                </form> --}}
                @if(Auth::hasUser() && Auth::user()->favourites->movies->contains($movie))
                <form method="POST" action="{{route('movie.unfav', ['id'=>$movie->hashid()])}}">
                    @csrf
                    <button style="pointer-events: all" type="submit" uk-icon="icon: minus"
                        uk-tooltip="Remove from favourites">
                    </button>
                </form>
                @else
                <form method="POST" action="{{route('movie.fav', ['id'=>$movie->hashid()])}}">
                    @csrf
                    <button style="pointer-events: all" type="submit" uk-icon="icon: plus"
                        uk-tooltip="Add to favourites">
                    </button>
                </form>
                @endif
            </div>
        </div>
    </div>
    <div class="uk-overlay uk-hidden-notouch uk-position-cover" {!! (($overlay ?? true)
        ? 'uk-toggle="target: #movie-modal-' .$movie->hashid().'"' :'') !!}>
    </div>

    <div>
        {{-- MODAL --}}
        <div id="movie-modal-{{$movie->hashid()}}" uk-modal
            class="uk-hidden-notouch uk-modal-full uk-animation-slide-bottom uk-light"
            style="background: rgba(26,32,44,0.67)">
            <div class="uk-modal-dialog uk-background-secondary">
                <button class="uk-modal-close-full uk-background-secondary uk-light" type="button" uk-close></button>
                <div class="uk-modal-header uk-background-secondary">
                    <h2 class="uk-modal-title">{{$movie->title}}</h2>
                </div>
                <div class="uk-modal-body">
                    <img loading="lazy" class="uk-align-center uk-height-max-medium" src="{{$movie->getThumbnailUrl()}}"
                        alt="">
                    <p>{{$movie->description}}</p>
                </div>
                <div class="uk-modal-footer uk-text-right uk-background-secondary">
                    @if(Auth::hasUser() && Auth::user()->favourites->movies->contains($movie))
                    <form method="POST" action="{{route('movie.unfav', ['id'=>$movie->hashid()])}}">
                        @csrf
                        <button style="pointer-events: all" type="submit" uk-icon="icon: minus"
                            uk-tooltip="Remove from favourites">
                        </button>
                    </form>
                    @else
                    <form method="POST" action="{{route('movie.fav', ['id'=>$movie->hashid()])}}">
                        @csrf
                        <button style="pointer-events: all" type="submit" uk-icon="icon: plus"
                            uk-tooltip="Add to favourites">
                        </button>
                    </form>
                    @endif

                    <button class="uk-button uk-button-default uk-modal-close uk-margin-medium-left" type="button">Close</button>
                    @can('view', $movie)
                    @can('watch', $movie)
                    <a href="{{route('movie.show', ['movie'=>$movie->hashid()])}}" class="uk-button uk-button-primary"
                        type="button">Watch
                        <span class="uk-margin-small-right" uk-icon="play"></span></a>
                    @else
                    <a href="{{route('profile.index') . '#choose-plan'}}" class="uk-button uk-button-primary"
                        type="button" uk-tooltip="title: Choose a plan to watch;pos: bottom; delay: 500">Choose
                        a plan to watch
                        <span class="uk-margin-small-right" uk-icon="lock"></span></a>
                    @endcan
                    @else
                    <a href="{{route('login')}}" class="uk-button uk-button-primary"
                        uk-tooltip="title: Log in to watch;pos: bottom; delay: 500" type="button">
                        <span class="uk-margin-small-right" uk-icon="lock"></span>
                        Log in to watch
                    </a>
                    @endcan
                </div>
            </div>
        </div>
    </div>
    @endif
    @else
    <div class="uk-card uk-card-secondary uk-card-body uk-width-medium">
        <h3 class="uk-card-title">Forbidden</h3>
        <p>Sorry, but you cannot access this data.</p>
    </div>
    @endcan
</div>
