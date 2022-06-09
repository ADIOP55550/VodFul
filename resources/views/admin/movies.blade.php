<x-layouts.admin>

    <div class="uk-container uk-margin-top uk-margin-bottom">
        <h1> Manage movies </h1>

        @php
        $movies = App\Models\Movie::paginate(20);
        // $plans = App\Models\Plan::all();
        @endphp
        {{$movies->links()}}

        <table class="uk-table uk-table-middle uk-table-small uk-table-hover uk-table-striped">
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Genre</th>
                <th>Year</th>
                <th>Date added</th>
                <th>Times watched</th>
                <th>Actions</th>
            </tr>
            @foreach ($movies->items() as $m)
            <tr>
                <td>{{$movies->firstItem() + $loop->index}}</td>
                <td>
                    <a href="{{route('movie.show', ['movie'=>$m->hashid()])}}">
                        {{$m->title}}
                    </a>
                </td>
                <td>{{$m->genre->name}}</td>
                <td>{{$m->year}}</td>
                <td>{{$m->created_at}}</td>
                <td>{{array_reduce(array_map(fn($v)=>$v['times_watched'],$m->watchedBy()->get()->toArray()),
                    fn($a,$b)=>$a+$b, 0)}}</td>
                <td>
                    <div class="uk-flex uk-flex-start">
                        {{-- <button
                            class="uk-margin-small-left uk-button uk-button-muted uk-button-small">Edit</button> --}}
                        <a title="Edit movie" uk-tooltip href="{{route('admin.movies.edit', ['movie'=>$m->hashid()])}}"
                            class="uk-margin-small-left uk-button uk-button-default uk-button-small">
                            <span uk-icon="icon: pencil"></span>
                        </a>
                        <form action="{{route('admin.movies.destroy', ['movie'=>$m->hashid()])}}" method="POST">
                            @csrf
                            @method('delete')
                            <button title="Delete movie" uk-tooltip class="uk-margin-small-left uk-button uk-button-default uk-button-small
                                uk-button-danger">
                                <span uk-icon="icon: trash"></span>
                            </button>
                        </form>

                        {{-- @if ($m->subscribed())
                        <button
                            class="uk-margin-small-left uk-button uk-button-default uk-button-small uk-button-danger">Remove
                            plan</button>
                        @endif --}}
                    </div>

                </td>
            </tr>
            @endforeach

        </table>
        {{$movies->links()}}


    </div>

</x-layouts.admin>
