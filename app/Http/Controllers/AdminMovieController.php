<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMovieRequest;
use App\Http\Requests\UpdateMovieRequest;
use App\Models\Genre;
use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class AdminMovieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.movies');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.movies.edit_or_create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMovieRequest $request)
    {
        $valid = $request->validated();
        Movie::factory()->create($valid);
        return to_route('admin.movies.index')->with('status.success', "Movie created");
    }

    /**
     * Display the specified resource.
     *
     * @param  string $movie_id
     * @return \Illuminate\Http\Response
     */
    public function show(string $movie_id)
    {
        $movie = Movie::fromHashId($movie_id);
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  string $movie_id
     * @return \Illuminate\Http\Response
     */
    public function edit(string $movie_id)
    {
        $movie = Movie::fromHashId($movie_id);
        return view('admin.movies.edit_or_create', ['movie' => $movie]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string $movie_id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMovieRequest $request, string $movie_id)
    {
        $movie = Movie::fromHashId($movie_id);
        $valid = $request->validated();

        $genre = Arr::pull($valid, 'genre');

        $movie->fill($valid);
        $movie->genre()->associate(Genre::query()->where('name', $genre)->firstOrFail());

        $movie->update();

        return to_route('admin.movies.index')->with('status.success', "Movie updated");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  string $movie_id
     * @return \Illuminate\Http\Response
     */
    public function destroy(string $movie_id)
    {
        $movie = Movie::fromHashId($movie_id);
        $movie->delete();

        return to_route('admin.movies.index')->with('status.success', "Movie deleted");
    }
}
