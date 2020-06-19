<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class User extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return \App\User::paginate(20);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate([
            'name' => 'required',
            'birth' => 'required|date_format:Y-m-d',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|max:255',
            'password_repeat' => 'required|min:6|max:255|same:password',
        ]);

        $user = \App\User::create($request->all());

        return response()->json(['data' => $user->toArray(), 'created' => true], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\User $user
     *
     * @return \Illuminate\Http\Response
     */
    public function show(\App\User $user)
    {
        return $user;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\User                $user
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, \App\User $user)
    {
        request()->validate([
            'birth' => 'date_format:Y-m-d',
            'email' => 'email|unique:users,email,'.$user->id,
            'password' => 'min:6|max:255',
            'password_repeat' => 'min:6|max:255|same:password'
        ]);

        $user->update($request->all());

        return $user;
    }

    /**
     * @param \App\User $user
     *
     * @throws \Exception
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(\App\User $user)
    {
        $user->delete();

        return response()->json(['deleted' => true], 202);
    }
}
