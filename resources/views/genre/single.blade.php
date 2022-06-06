<x-layouts.user>

    @php
    if(!isset($genre))
    throw new Error();
    $movies = App\Models\Movie::query()->whereBelongsTo($genre)->paginate(16);
    @endphp


    <div class="uk-container uk-margin-large-top">
        <div class="uk-hidden@m uk-margin-xlarge-top"></div>
        <ul class="uk-breadcrumb uk-margin-top">
            <li><a href="{{route('homepage')}}">Home</a></li>
            <li><a href="{{route('genres.index')}}">Genres</a></li>
            <li><span>{{$genre->name}}</span></li>
        </ul>

        <h1 class="uk-heading-medium uk-margin-top">{{$genre->name}}</h1>
        <div id="movies-list"
            class="uk-child-width-1-2 uk-child-width-1-3@s uk-child-width-1-4@m uk-child-width-1-5@l uk-child-width-1-6@xl"
            uk-grid {{-- uk-scrollspy="cls:uk-animation-slide-top-small;delay: 80;target:>div" --}}>
        </div>
        <span id="bottom-detector" uk-scrollspy="repeat:true"></span>


        <script src="/js/homepage/genre.js"></script>
        <script>
            initListener(1, "{{route('genre.movies.page', ['id'=>$genre->hashid()])}}");
        </script>
    </div>

</x-layouts.user>
