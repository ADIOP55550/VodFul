<x-layouts.admin>
    {{-- <x-slot name="title"> --}}
        {{-- Dashboard --}}
        {{-- </x-slot> --}}

    <div class="uk-container uk-margin-top uk-margin-bottom">
        <h1> Manage users </h1>

        @php
        $users = App\Models\User::paginate(20);
        $plans = App\Models\Plan::all();
        @endphp
        {{-- <a class="uk-button uk-button-default" href="#create-user-modal" uk-toggle>Open</a> --}}

        <table class="uk-table uk-table-middle uk-table-small uk-table-hover uk-table-striped">
            <tr>
                <th>#</th>
                <th>Email</th>
                <th>User Full name</th>
                <th>Plan</th>
                {{-- <th>Movies watched</th> --}}
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
                        {{-- <button class="uk-margin-small-left uk-button uk-button-muted uk-button-small">Edit</button> --}}
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
