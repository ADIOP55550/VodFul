<x-layouts.admin>

    <div class="uk-container uk-margin-top uk-margin-bottom">
        <h1> Manage users </h1>

        @php
        $plans = App\Models\Plan::all();
        $request = request();

        $page = $request->filled('page') ? $request->get('page') : 1;
        $perPage = $request->filled('perPage') ? $request->get('perPage') : 20;
        $search = $request->filled('search') ? $request->get('search') : null;

        $isAdminFilter = $request->filled('isAdmin') ? $request->boolean('isAdmin') : null;

        $query = App\Models\User::query();

        if($isAdminFilter !== null)
        $query = App\Models\User::where('is_admin', $isAdminFilter);

        if($search !== null)
        $query = $query->where(fn($query)=>
        $query
        ->orWhere('name', 'like', '%' . $search . '%')
        ->orWhere('email', 'like', '%' . $search . '%')
        );

        $data = $query->get();

        $users = new \Illuminate\Pagination\LengthAwarePaginator($data->slice(($page-1)*$perPage, $perPage),
        $data->count(), $perPage, $page, [
        'path' => $request->url(),
        'query' => $request->query(),
        ]);
        @endphp


        <div class=" uk-margin">
            <form action="" method="GET" id="filters" class="uk-flex">

                <div class="uk-margin-right">
                    <div uk-form-custom="target: > * > span:first-child">
                        <select name="isAdmin" onchange="document.querySelector('#filters').submit()">
                            <option value="" @selected($isAdminFilter===null)>Any</option>
                            <option value="1" @selected($isAdminFilter===true)>Yes</option>
                            <option value="0" @selected($isAdminFilter===false)>No</option>
                        </select>

                        <button class="uk-button uk-button-default" type="button" tabindex="-1">
                            Is admin: <span></span>
                            <span uk-icon="icon: chevron-down"></span>
                        </button>
                    </div>
                </div>
                <div class="uk-margin-right">
                    <div uk-form-custom="target: > * > span:first-child">
                        <select name="perPage" onchange="document.querySelector('#filters').submit()">
                            @php
                            $options = collect([5,10,20,30,40,50,100]);
                            @endphp
                            @foreach ($options->merge([$perPage])->unique()->sort() as $p)
                            <option value="{{$p}}" @selected($perPage==$p)>
                                {{$p}}
                            </option>
                            @endforeach
                        </select>

                        <button class="uk-button uk-button-default" type="button" tabindex="-1">
                            Per page: <span></span>
                            <span uk-icon="icon: chevron-down"></span>
                        </button>
                    </div>
                </div>


                <div>
                    <div class="uk-search uk-search-default uk-margin-right">
                        <span uk-search-icon class="uk-search-icon-flip"></span>
                        <input title="Search by name or email" uk-tooltip class="uk-search-input" value="{{request('search','')}}" onfocus="this.select()"
                            name="search" type="search" placeholder="Search">
                    </div>
                </div>

                <a href="{{route('admin.users.index')}}" class="uk-button uk-button-default">
                    Clear filters
                </a>
            </form>
        </div>

        {{$users->links()}}

        <table class="uk-table uk-table-middle uk-table-small uk-table-hover uk-table-striped">
            <tr>
                <th>#</th>
                <th>Email</th>
                <th>User Full name</th>
                <th>Plan</th>
                <th>Date joined</th>
                <th>Is admin</th>
                <th>Actions</th>
            </tr>
            @foreach ($users->items() as $u)
            <tr>
                <td>{{$users->firstItem() + $loop->index}}</td>
                <td>{{$u->email}}</td>
                <td class="uk-text-truncate uk-preserve-width" uk-tooltip="title:{{$u->name}}; pos:right">{{$u->name}}
                </td>
                @php
                $plan = $u->getPlan();
                @endphp
                <td>{{$plan ?? "-"}}</td>
                {{-- <td>{{$u->watchStatuses()->count()}}</td> --}}
                <td>{{$u->created_at}}</td>
                <td>
                    {{-- {{$u->isAdmin() == 1 ? "Yes" : "No"}} --}}
                    <form method="POST" action="{{route('admin.users.toggle-admin', ['id'=>$u->hashid()])}}">
                        @csrf
                        <button href="" @disabled($u->id == Auth::user()->id) title="{{$u->id == Auth::user()->id ?
                            'You cannot demote yourself':($u->isAdmin() ? "Demote" : "Promote") }}" uk-tooltip
                            @class(['uk-button', 'uk-button-small' , 'uk-button-danger'=> !$u->isAdmin()])>
                            {{$u->isAdmin() ? "Yes" : "No"}}
                        </button>
                    </form>
                </td>
                <td>
                    <div class="uk-flex uk-flex-start">
                        {{-- <button
                            class="uk-margin-small-left uk-button uk-button-muted uk-button-small">Edit</button> --}}
                        <form action="{{route('admin.users.destroy', ['user'=>$u->hashid()])}}" method="POST">
                            @csrf
                            @method('delete')
                            <button title="{{$u->id == Auth::user()->id ? 'You cannot delete yourself':'Delete user'}}"
                                uk-tooltip @disabled($u->id == Auth::user()->id)
                                class="uk-margin-small-left uk-button uk-button-default uk-button-small
                                uk-button-danger">
                                <span uk-icon="icon: trash"></span>
                            </button>
                        </form>

                        {{-- @if ($u->subscribed())
                        <button
                            class="uk-margin-small-left uk-button uk-button-default uk-button-small uk-button-danger">Remove
                            plan</button>
                        @endif --}}
                    </div>

                </td>
            </tr>
            @endforeach

        </table>
        {{$users->links()}}


    </div>



    {{-- <div id="create-user-modal" uk-modal>
        <div class="uk-modal-dialog">
            <button class="uk-modal-close-default" type="button" uk-close></button>
            <div class="uk-modal-header">
                <h2 class="uk-modal-title">Modal Title</h2>
            </div>
            <div class="uk-modal-body">
                <form action="{{route('admin.users.store')}}" method="POST">
                    @csrf
                    <input type="text" name="name" id="name-input">
                    <input type="text" name="email" id="email-input">
                </form>
            </div>
            <div class="uk-modal-footer uk-text-right">
                <button class="uk-button uk-button-default uk-modal-close" type="button">Cancel</button>
                <button class="uk-button uk-button-primary" type="button">Save</button>
            </div>
        </div>
    </div> --}}
</x-layouts.admin>
