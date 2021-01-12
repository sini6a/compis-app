<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\Computer;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Address;
use App\Subscription;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
        /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

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
        return view('admin.user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'phone_number' => 'required|regex:/(07)[0-9]{8}/|unique:users',
        ]);

        $password = Str::random(8);
        $address = Address::create();

        $user = User::create([
            'phone_number' => $request->get('phone_number'),
            'password' => Hash::make($password),
            'address_id' => $address->id,
        ]);

        dd($password);

        return redirect()->route('admin.user.show', $user)->with('status', 'Profile successfully created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $computers = Computer::where('user_id', $user->id)->paginate(10);
        return view('admin.user.show', compact('user', 'computers'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $subscriptions = Subscription::all(); 
        $selectedSubscription = $user->subscription_id;
        return view('admin.user.edit', compact('user', 'subscriptions', 'selectedSubscription'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'nullable|max:128',
            'email' => ['required', 'email', 'nullable', Rule::unique('users')->ignore($user->id)], 
            'address' => 'required',
            'address_two' => 'nullable',
            'postal_code' => 'numeric|required',
            'discount' => 'numeric|required',
            'subscription_id' => 'numeric|required'
        ]);

        User::where('id', $user->id)
          ->update(request()->only('name', 'email', 'discount', 'subscription_id'));

        Address::where('id', $user->address_id)
          ->update(request()->only('address', 'address_two', 'postal_code'));

        return redirect()->route('admin.user.show', $user)->with('status', 'Profile successfully updated.');
    }

    public function discount(User $user, $discount)
    {
        if(!is_numeric($discount)) {
            return redirect()->route('admin.user.show', $user)->withError('Specified discount is not a number!');
        }

        if($user->discount >= 100) {

            return redirect()->route('admin.user.show', $user)->withError('User cannot have higher discount!');
        }

        if($user->discount + $discount >= 100) {
            $user->discount = 100;
        } else {
            $user->discount += $discount;
        }

        $user->save();

        $username = $user->name ? $user->name : $user->phone_number;

        return redirect()->route('admin.user.show', $user)->withStatus('Sucessfully added ' . $discount . '% discount to user: ' . $username);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}
