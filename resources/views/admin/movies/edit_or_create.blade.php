<x-layouts.admin>

    <div class="uk-container uk-margin-top uk-margin-bottom">
        <h1> {{isset($movie) ? 'Edit' : 'Create'}} movie </h1>

        @php($route = isset($movie) ? route('admin.movies.update', ['movie'=>$movie->hashid()]) :
        route('admin.movies.store'))

        <form method="POST" action="{{$route}}" class="uk-width-large@l uk-width-1-1">
            @csrf
            @isset($movie)
            @method('put')
            @endisset

            <div class="uk-margin">
                <label>
                    Title:
                    <input class="uk-input" type="text" required minlength="3" name="title" id="title-input"
                        value="{{ old('title', isset($movie) ? $movie->title : '') }}">
                </label>
            </div>
            <div class="uk-margin">
                <label>
                    Year:
                    <input class="uk-input" type="number" required min="1800" max="{{now()->year}}" name="year"
                        id="year-input" value="{{ old('year', isset($movie) ? $movie->year : '') }}">
                </label>
            </div>
            <div class="uk-margin">
                <label>
                    Video link (format yt:ID_YOUTUBE):
                    <input class="uk-input" type="text" name="video" id="video-input" pattern="^yt:[^\x22&?/\s]{11}$"
                        value="{{ old('video', isset($movie) ? $movie->video : '') }}">
                </label>
            </div>
            <div class="uk-margin">
                <label>
                    Genre:
                    <select class="uk-select" name="genre" id="genre-input">
                        <option value="" selected hidden>Choose genre...</option>
                        @foreach (App\Models\Genre::all() as $genre)
                        <option value="{{$genre->name}}" @selected(old('genre', isset($movie) ? $movie->genre->name :
                            '') == $genre->name)>{{$genre->name}}</option>
                        @endforeach
                    </select>
                </label>
            </div>
            <div class="uk-margin">
                <label>
                    Description:
                    <textarea class="uk-textarea" name="desctiprion" rows="5"
                        id="desctiprion-input">{{ old('description', isset($movie) ? $movie->description : '') }}</textarea>
                </label>
            </div>

            <div>
                <a href="{{route('admin.movies.index')}}" class="uk-button uk-button-muted">Cancel</a>
                <button type="submit" class="uk-button uk-button-primary">Save</button>
            </div>
        </form>


    </div>

</x-layouts.admin>
