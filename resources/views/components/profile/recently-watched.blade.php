<h2>
    Your recent movies:
</h2>

<div class="uk-flex uk-flex-wrap uk-flex-wrap-between uk-flex-between">

    @forelse (Auth::user()->watchStatuses->sortByDesc('last_watched')->take(5) as $ws)

    <x-movie.thumbnail :movie="$ws->movie" />

    @empty
    <div class="uk-placeholder uk-width-1-1 uk-height-1-1 uk-light uk-text-center">You haven't watched anything yet</div>
    @endforelse
</div>
