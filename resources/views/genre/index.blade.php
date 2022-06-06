<x-layouts.user>

    <div class="uk-container uk-margin-large-top uk-margin-bottom">
        <div class="uk-hidden@m uk-margin-xlarge-top"></div>

        <ul class="uk-breadcrumb uk-margin-top">
            <li><a href="{{route('homepage')}}">Home</a></li>
            <li><span>Genres</span></li>
        </ul>

        <div class="uk-child-width-1-2@m uk-child-width-1-3@l uk-child-width-1-4@xl" uk-grid
            uk-scrollspy="cls:uk-animation-slide-top-small;delay: 80;target:a">
            @foreach(\App\Models\Genre::all() as $genre)


            <a href="/genres/{{$genre->hashid()}}">
                <div>
                    <div class="uk-inline uk-transition-toggle uk-overflow-hidden">
                        <img src="https://loremflickr.com/320/240/{{$genre->name}}" width="1800" height="1200" alt="">
                        <div class="uk-overlay uk-overlay-primary uk-position-top uk-padding-remove-vertical">
                            <h3 class="uk-margin-medium-top">{{$genre->name}}</h3>
                            @php($count = ($genre??null)->movies->count())
                            <div class="uk-card-badge uk-label uk-transition-slides-top">{{$count}}
                                {{\Illuminate\Support\Str::plural("movie", $count)}}</div>
                        </div>
                    </div>
                </div>
            </a>


            @endforeach
        </div>
    </div>

</x-layouts.user>
