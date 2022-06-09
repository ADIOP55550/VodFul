<x-layouts.admin>
    {{-- <x-slot name="title"> --}}
        {{-- Dashboard --}}
        {{-- </x-slot> --}}

    <div class="uk-container uk-margin-top">
        <h1> Admin panel </h1>

        <nav class="uk-grid uk-child-width-1-1 uk-child-width-1-2@m uk-child-width-1-3@l" uk-grid>
            <div>
                <div class="uk-card uk-card-primary uk-card-body">
                    <h3 class="uk-card-title">Users</h3>
                    <ul>
                        <li>
                            <a href="{{route('admin.users.index')}}">Manage users</a>
                        </li>
                        {{-- <li> --}}
                            {{-- <a href="{{route('register')}}">Registration link</a> --}}
                            {{-- </li> --}}
                    </ul>
                </div>
            </div>

            <div>
                <div class="uk-card uk-card-primary uk-card-body">
                    <h3 class="uk-card-title">Movies</h3>
                    <ul>
                        <li>
                            <a href="{{route('admin.movies.index')}}">Manage movies</a>
                        </li>
                        <li>
                            <a href="{{route('admin.movies.create')}}">Create new movie</a>
                        </li>
                    </ul>
                </div>
            </div>

            <div>
                <div class="uk-card uk-card-primary uk-card-body">
                    <h3 class="uk-card-title">Plans</h3>
                    <ul>
                        <li>
                            <a href="{{route('admin.plans.index')}}">Manage plans</a>
                        </li>
                        <li>
                            <a href="#add-plan-modal" uk-toggle>Create new plan</a>
                        </li>
                        <li>
                            <a href="https://dashboard.stripe.com/test/dashboard" target="_blank">Manage prices</a>
                        </li>
                    </ul>
                </div>
            </div>

        </nav>
    </div>

    <x-admin.add-plan-modal />

</x-layouts.admin>
