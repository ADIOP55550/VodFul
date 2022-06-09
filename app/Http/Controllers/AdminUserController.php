<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.users');
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->last) {
            $user = session()->get('deletedUser');
            abort_if(is_null($user), 422);

            $user->save();
            return back()->with('status.success', "User created.");
        }

        $user = User::create($request->all());

        return back()->with('status.success', "User created.");
    }

    /**
     * Display the specified resource.
     *
     * @param  string $user_id
     * @return \Illuminate\Http\Response
     */
    public function show(string $user_id)
    {
        $user = User::fromHashId($user_id);
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  string $user_id
     * @return \Illuminate\Http\Response
     */
    public function edit(string $user_id)
    {
        $user = User::fromHashId($user_id);
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string $user_id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, string $user_id)
    {
        $user = User::fromHashId($user_id);
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  string $user_id
     * @return \Illuminate\Http\Response
     */
    public function destroy(string $user_id)
    {
        $user = User::fromHashId($user_id);
        $user->delete();

        session(['deletedUser' => $user]);
        return back()->with('status.success', "User " . $user->name .  " deleted." . $this->getUndoForm(route('admin.users.store', ['last' => true])));
    }
}
