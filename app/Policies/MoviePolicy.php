<?php

namespace App\Policies;

use App\Models\Movie;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class MoviePolicy
{
    use HandlesAuthorization;

    public function before(User $user)
    {
        return $user->is_admin ? true : null;
    }

    /**
     * Determine whether the user can view any models.
     *
     * @param \App\Models\User $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user = null)
    {
        // True also for guests
        return true;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param \App\Models\User $user
     * @param \App\Models\Movie $movie
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Movie $movie)
    {
        // return true, user must be logged in
        return true;
    }


    /**
     * Determine whether the user can watch any movie.
     *
     * @param \App\Models\User $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function watchAnyMovie(User $user)
    {
        return $user->subscribed();
    }


    /**
     * Determine whether the user can watch the movie.
     *
     * @param \App\Models\User $user
     * @param \App\Models\Movie $movie
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function watch(User $user, Movie $movie)
    {
        return $user->subscribed();
    }

    /**
     * Determine whether the user can create models.
     *
     * @param \App\Models\User $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return $user->is_admin;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param \App\Models\User $user
     * @param \App\Models\Movie $movie
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Movie $movie)
    {
        return $user->is_admin;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param \App\Models\User $user
     * @param \App\Models\Movie $movie
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Movie $movie)
    {
        return $user->is_admin;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param \App\Models\User $user
     * @param \App\Models\Movie $movie
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Movie $movie)
    {
        return $user->is_admin;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param \App\Models\User $user
     * @param \App\Models\Movie $movie
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Movie $movie)
    {
        return $user->is_admin;
    }
}
