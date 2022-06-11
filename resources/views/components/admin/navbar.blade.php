<nav class="uk-navbar-container uk-position-z-index" uk-navbar>

    <div class="uk-navbar-left">

        <ul class="uk-navbar-nav">
            <li class="{{ Str::of(Route::currentRouteName())->startsWith('admin.index') ? 'uk-active' : '' }}">
                <a href="{{route('admin.index')}}">Home</a>
            </li>
            <li class="{{ (Str::of(Route::currentRouteName())->startsWith('admin.plans') ) ? 'uk-active' : '' }}"><a
                    href="{{route('admin.plans.index')}}">Plans</a></li>
            <li class="{{ (Str::of(Route::currentRouteName())->startsWith('admin.users') ) ? 'uk-active' : '' }}"><a
                    href="{{route('admin.users.index')}}">Users</a></li>
            <li class="{{ (Str::of(Route::currentRouteName())->startsWith('admin.movies') ) ? 'uk-active' : '' }}"><a
                    href="{{route('admin.movies.index')}}">Movies</a></li>
        </ul>

    </div>

    <div class="uk-navbar-right">

        <ul class="uk-navbar-nav">
            <li><a href="{{route('homepage')}}">Back to user portal</a></li>

            <li class="uk-margin-left"><a href="{{route('logout')}}">Logout</a></li>
        </ul>

    </div>

</nav>
