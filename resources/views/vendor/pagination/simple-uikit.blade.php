@if ($paginator->hasPages())
    <nav>
        <ul class="uk-pagination">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="uk-disabled"><a href="#"><span uk-pagination-previous></span>@lang('pagination.previous')</a>
                </li>
            @else
                <li><a href="{{ $paginator->previousPageUrl() }}" rel="prev"><span
                            uk-pagination-previous></span>@lang('pagination.previous')</a></li>
            @endif

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li><a href="{{ $paginator->nextPageUrl() }}" rel="next">@lang('pagination.next')<span
                            uk-pagination-next></span></a></li>
            @else
                <li class="uk-disabled"><a href="#">@lang('pagination.next')<span uk-pagination-next></span></a></li>
            @endif
        </ul>
    </nav>
@endif

