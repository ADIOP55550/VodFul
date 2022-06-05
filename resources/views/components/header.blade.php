<nav class="uk-navbar-container uk-navbar-transparent uk-light uk-position-z-index uk-visible@s" uk-navbar
     style="background: linear-gradient(90deg, rgba(0,0,0,0) 20% ,rgba(26,32,44,0.7) 45% ,rgba(26,32,44,0.7) 55% ,rgba(0,0,0,0) 80%);">
    <div class="uk-navbar-center">

        <div class="uk-navbar-center-left">
            <div>
                <ul class="uk-navbar-nav">
                    <li><a href="{{route('homepage')}}">Główna</a></li>
                    <li>
                        <a href="{{route('genres.index')}}">Gatunki</a>
                        <div class="uk-navbar-dropdown uk-navbar-dropdown-width-2 uk-background-secondary">
                            <div class="uk-navbar-dropdown-grid uk-child-width-1-2" uk-grid>
                                @php($allGenres = collect(\App\Models\Genre::all()))
                                @foreach($allGenres->chunk(ceil($allGenres->count()/2)) as $genres)
                                    <div>
                                        <ul class="uk-nav uk-navbar-dropdown-nav">
                                            @foreach($genres as $genre)
                                                <li>
                                                    <a href="{{route('genres.show', ['genre'=>strtolower($genre->name)])}}">{{$genre->name}}</a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
        <a class="uk-navbar-item uk-logo" href="#">
            <img src="/images/logo/logo.svg" alt="logo" width="70px">
        </a>
        <div class="uk-navbar-center-right">
            <div>
                {{--                @dump(\Illuminate\Support\Facades\Auth::user())--}}
                {{--                @dump(\Illuminate\Support\Facades\Auth::hasUser())--}}
                <ul class="uk-navbar-nav">
                    @if(\Illuminate\Support\Facades\Auth::check())
                        <li><a href="/profile">Profil</a></li>
                        <li><a href="/logout">Log out</a></li>
                    @else
                        <li><a href="/login" onclick="openLoginModal(); return false;">Login</a></li>
                    @endif
                </ul>
            </div>
        </div>

    </div>
</nav>

<div
    uk-sticky="sel-target: .uk-navbar-container; cls-active: uk-navbar-sticky; show-on-up: true; animation: uk-animation-slide-top">

    <nav class="uk-navbar-container  uk-hidden@s uk-position-z-index uk-light"
         uk-navbar="mode: click"
         style="background: #1a202c"
    >
        <div class="uk-navbar-left">

            <ul class="uk-navbar-nav">
                <li class="uk-active"><a href="#offcanvas-nav" uk-toggle>
                        <span uk-icon="menu"></span>
                    </a></li>
                <li><a href="{{route('homepage')}}">Główna</a></li>
            </ul>

        </div>
    </nav>
</div>

{{-- FOR MOBILE --}}
<div id="offcanvas-nav" class="uk-hidden@m" uk-offcanvas="mode: push; overlay: true">
    <div class="uk-offcanvas-bar">
        <ul class="uk-nav uk-nav-primary uk-nav-parent-icon" uk-nav>
            <li><a href="{{route('homepage')}}">Główna</a></li>
            <li class="uk-parent {{ request()->routeIs('genres.index') || request()->routeIs('genres.show') ? 'uk-open' : ''}}">
                <a href="#">Gatunki</a>
                <ul class="uk-nav-sub">
                    @php($genres = collect(\App\Models\Genre::all()))
                    @foreach($genres as $genre)
                        <li>
                            <a href="{{route('genres.show', ['genre'=>strtolower($genre->name)])}}">{{$genre->name}}</a>
                        </li>
                    @endforeach
                </ul>
            </li>

            <li class="uk-nav-header">Użytkownik</li>
            @if(\Illuminate\Support\Facades\Auth::check())
                <li><a href="/profile">Profil</a></li>
                <li><a href="/logout">Log out</a></li>
            @else
                <li><a href="/login" onclick="openLoginModal(); return false;">Login</a></li>
            @endif
        </ul>
    </div>
</div>
