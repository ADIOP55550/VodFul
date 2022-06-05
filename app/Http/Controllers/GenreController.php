<?php

namespace App\Http\Controllers;

use App\Http\Resources\MovieCollection;
use App\Http\Resources\MovieResource;
use App\Models\Genre;
use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Gate;

class GenreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return view("genre.index");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param string $genre_id
     * @return Response
     */
    public function show(string $genre_id)
    {
        $genre = Genre::query()->where("name", $genre_id)->get();
        if ($genre->isNotEmpty()) return view("genre.single", ["genre" => $genre[0]]);

        $genre = Genre::fromHashId($genre_id);
        return view("genre.single", ["genre" => $genre]);
    }

    /**
     * Display the specified resource.
     *
     * @param string $genre_id
     * @param Request $request
     * @return Response
     */
    public function showMovies(Request $request, string $genre_id)
    {
        abort_if(!$request->acceptsJson(), 400);

        $genre = Genre::query()->where("name", $genre_id)->get();
        if ($genre->isEmpty()) {
            $genre = Genre::fromHashId($genre_id);
        }

        $movies = Movie::query()->whereBelongsTo($genre)->simplePaginate(16, page: $request->page);
//        $items = $movies->items();
//        $items = array_map(function ($item) {
//            return $item->toPageValue();
//        }, $items);
//        $data = $movies->toArray();
//        $data['data'] = $items;
        return new MovieCollection($movies);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Genre $genre
     * @return Response
     */
    public function edit(Genre $genre)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Genre $genre
     * @return Response
     */
    public function update(Request $request, Genre $genre)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Genre $genre
     * @return Response
     */
    public function destroy(Genre $genre)
    {
        //
    }
}
