<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use GrahamCampbell\ResultType\Success;
use Illuminate\Auth\Access\Gate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate as FacadesGate;

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
        $user = Auth::user();
        $movie = Movie::fromHashId($movie_id);
        if (FacadesGate::check('watch', $movie)) {
            $u = \App\Models\User::findOrFail($user->id);
            $u->watches($movie);
        }
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
        $user = Auth::user();


        $playlist = $user->favourites;
        $playlist->movies()->attach($movie);
        $playlist->updateOrFail();
        // dd($movie);
        return back()->with('status.success', 'Added to favourites!' . $this->getUndoForm(route('movie.unfav', ['id' => $movie_id])));
    }
    public function removeFromFavourites(string $movie_id)
    {
        $movie = Movie::fromHashId($movie_id);
        $user = Auth::user();


        $playlist = $user->favourites;
        $playlist->movies()->detach($movie);
        $playlist->updateOrFail();
        // dd($movie);
        return back()->with('status.info', 'Removed from favourites!' . $this->getUndoForm(route('movie.fav', ['id' => $movie_id])));
    }

    public function removeFromRecommendations(string $movie_id)
    {
        $movie = Movie::fromHashId($movie_id);
        $user = Auth::user();

        $playlist = $user->ignored;
        $playlist->movies()->attach($movie);
        $playlist->updateOrFail();
        // dd($movie);
        return back()->with('status.info', 'Added to ignored!' . $this->getUndoForm(route('movie.unban', ['id' => $movie_id])));
    }

    public function addToRecommendations(string $movie_id)
    {
        $movie = Movie::fromHashId($movie_id);
        $user = Auth::user();

        $playlist = $user->ignored;
        $playlist->movies()->detach($movie);
        $playlist->updateOrFail();
        // dd($movie);
        return back()->with('status.info', 'Removed from ignored!' . $this->getUndoForm(route('movie.ban', ['id' => $movie_id])));
    }


    public function getThumbnailComponent(Request $request)
    {
        $movie = Movie::fromHashId($request->id);

        return view('components.movie.thumbnail', ['movie' => $movie, "attributes" => new \Illuminate\View\ComponentAttributeBag(), 'overlay' => !!$request->overlay]);
    }
}
