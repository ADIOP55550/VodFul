<nav class="uk-navbar-container uk-position-z-index" uk-navbar>

    <div class="uk-navbar-left">

        <ul class="uk-navbar-nav">
            <li class="{{ (strpos(Route::currentRouteName(), 'admin.index' )==0) ? 'uk-active' : '' }}">
                <a href="{{route('admin.index')}}">Home</a>
            </li>
            <li><a href="{{route('homepage')}}">Back to user portal</a></li>
        </ul>

    </div>
    {{-- <div class="uk-navbar-center">
        Lol
    </div> --}}

    <div class="uk-navbar-right">

        <ul class="uk-navbar-nav">
            <li><a href="{{route('admin.plans.index')}}">Plans</a></li>
            <li><a href="{{route('admin.users.index')}}">Users</a></li>
            <li><a href="{{route('admin.movies.index')}}">Movies</a></li>
            {{-- <li>
                <a href="#">Parent</a>
                <div class="uk-navbar-dropdown">
                    <ul class="uk-nav uk-navbar-dropdown-nav">
                        <li class="uk-active"><a href="#">Active</a></li>
                        <li><a href="#">Item</a></li>
                        <li><a href="#">Item</a></li>
                    </ul>
                </div>
            </li> --}}
            <li class="uk-margin-left"><a href="{{route('logout')}}">Logout</a></li>
        </ul>

    </div>

</nav>
