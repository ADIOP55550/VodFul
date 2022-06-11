<x-layouts.admin>

    <div class="uk-container uk-margin-top uk-margin-bottom">
        <h1> Manage movies </h1>

        @php
        $request = request();

        $page = $request->has('page') ? $request->get('page') : 1;
        $perPage = $request->has('perPage') ? $request->get('perPage') : 20;

        $genreFilter = request('genre', null);
        $search = $request->filled('search') ? $request->get('search') : null;


        $query = App\Models\Movie::query();
        // if(is_null($genreFilter)){
        // }
        // else{
        // $query = App\Models\Genre::where('name', $genreFilter)->firstOrFail()->movies();
        // }

        if($genreFilter !== null)
        $query = $query->whereBelongsTo(App\Models\Genre::where('name', $genreFilter)->firstOrFail());



        if($search !== null)
        $query = $query->where(fn($query)=>
        $query
        ->orWhere('title', 'like', '%' . $search . '%')
        ->orWhere('description', 'like', '%' . $search . '%')
        ->orWhere(fn($q)=>
        App\Models\Genre::where('name','like' ,'%'.$search.'%')->get()->whenNotEmpty(
        fn($genres)=>
        $q->orWhereBelongsTo($genres)
        ,
        fn($empty)=>$q
        )
        )
        ->orWhere('year', '=', $search)
        );

        $data = $query->get();


        $movies = new \Illuminate\Pagination\LengthAwarePaginator($data->slice(($page-1)*$perPage, $perPage),
        $data->count(), $perPage, $page, [
        'path' => $request->url(),
        'query' => $request->query(),
        ]);
        @endphp

        <p class="uk-text-muted">
            Tip: hover over movie link to see description
        </p>

        <a href="{{route('admin.movies.create')}}" class="uk-button uk-button-primary">
            Create new movie
        </a>

        <div class=" uk-margin">
            <form action="" method="GET" id="filters" class="uk-flex">
                <div class="uk-margin-right">
                    <div uk-form-custom="target: > * > span:first-child">
                        <select name="genre" onchange="document.querySelector('#filters').submit()">
                            <option value="">All genres</option>
                            @foreach (App\Models\Genre::all() as $g)
                            <option value="{{strtolower($g->name)}}" @selected(isset($genreFilter) &&
                                $genreFilter==strtolower($g->name))>
                                {{$g->name}}
                            </option>
                            @endforeach
                        </select>

                        <button class="uk-button uk-button-default" type="button" tabindex="-1">
                            <span></span>
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
                        <input title="Search by name, description, genre or year" uk-tooltip class="uk-search-input" value="{{request('search','')}}" onfocus="this.select()"
                            name="search" type="search" placeholder="Search">
                    </div>
                </div>


                <a href="{{route('admin.movies.index')}}" class="uk-button uk-button-default">
                    Clear filters
                </a>
            </form>
        </div>

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
            <tr id="row-{{$movies->firstItem() + $loop->index}}">
                <td>{{$movies->firstItem() + $loop->index}}</td>
                <td>
                    <a href="{{route('movie.show', ['movie'=>$m->hashid()])}}">
                        {{$m->title}}
                    </a>
                    <div uk-drop="pos: right-center;delay-show: 200; delay-hide:0">
                        <div class="uk-card uk-card-body uk-card-default">
                            {{$m->description}}
                        </div>
                    </div>
                </td>
                <td>{{$m->genre->name}}</td>
                <td>{{$m->year}}</td>
                <td>{{$m->created_at}}</td>
                <td>{{array_reduce(array_map(fn($v)=>$v['times_watched'],$m->watchedBy()->get()->toArray()),
                    fn($a,$b)=>$a+$b, 0)}}</td>
                <td>
                    <div class="uk-flex uk-flex-start">
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
                    </div>
                </td>
            </tr>
            @endforeach

        </table>
        {{$movies->links()}}


    </div>

</x-layouts.admin>
