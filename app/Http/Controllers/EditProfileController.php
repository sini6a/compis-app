<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Address;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;


class EditProfileController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Computer  $computer
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $user = User::findOrFail(auth()->id());
        return view('auth.edit', compact('user'));
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Computer  $computer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        // dd(request()->only('name'));

        $request->validate([
            'name' => 'nullable|max:128',
            // 'email' => 'email|nullable|unique:users',
            'email' => ['required', 'email', 'nullable', Rule::unique('users')->ignore($user->id)], 
            'address' => 'required',
            'address_two' => 'nullable',
            'postal_code' => 'numeric|required'
        ]);

        User::where('id', $user->id)
          ->update(request()->only('name', 'email'));

        Address::where('id', $user->address_id)
          ->update(request()->only('address', 'address_two', 'postal_code'));

        // Session::flash('status', 'success');
        return redirect('home')->with('status', 'Din profil är redigerad.');;
    }

}
