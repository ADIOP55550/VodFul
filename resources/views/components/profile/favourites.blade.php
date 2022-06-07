@php
$paginator = Auth::user()->favourites->movies()->simplePaginate(5);
@endphp

{{-- @push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', ()=>{
        let btn = document.querySelector('#loadMoreFavourites');
        let next_page = "{{$paginator->nextPageUrl()}}";
        if(btn)
            btn.addEventListener('click', ()=>{
                axios.get()
                console.log('more');
            });
    });
</script>
@endpush --}}
<div>

    <h2>
        Your favourite movies:
    </h2>


    <div class="uk-flex uk-flex-wrap uk-flex-wrap-between uk-flex-between">
        @forelse ($paginator->items() as $movie)
        <x-movie.thumbnail :movie="$movie" />
        @empty
        <div class="uk-placeholder uk-width-1-1 uk-height-1-1 uk-light uk-text-center">You haven't added any movies to
            favourites yet
        </div>
        @endforelse
    </div>
    @if ($paginator->hasPages())
    <div class="uk-inline uk-padding-small uk-width-1-1 ">
        {{$paginator->links()}}
        {{-- <button class="uk-button uk-button-large uk-button-secondary uk-display-block uk-margin-auto"
            id="loadMoreFavourites">
            Load more...
        </button> --}}
    </div>
    @endif


</div>
