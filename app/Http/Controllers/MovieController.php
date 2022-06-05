<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Auth\Access\Gate;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Movie $movie
     * @return \Illuminate\Http\Response
     */
    public function show(string $movie_id)
    {
        $movie = Movie::fromHashId($movie_id);
        return view('movie.single', ['movie' => $movie]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Movie $movie
     * @return \Illuminate\Http\Response
     */
    public function edit(Movie $movie)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Movie $movie
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Movie $movie)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Movie $movie
     * @return \Illuminate\Http\Response
     */
    public function destroy(Movie $movie)
    {
        //
    }

    public function addToFavourites(string $movie_id)
    {
        $movie = Movie::fromHashId($movie_id);
        dd($movie);
        back();
    }

    public function removeFromRecommendations(string $movie_id)
    {
        $movie = Movie::fromHashId($movie_id);
        dd($movie);
        back();
    }

    public function getThumbnail(string $movie_id)
    {
        $movie = Movie::fromHashId($movie_id);
//        return response()->download($movie->image->filename);
//        back();
    }
}
