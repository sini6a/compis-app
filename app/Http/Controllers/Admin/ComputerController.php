<?php

namespace App\Http\Controllers\Admin;

use App\Computer;
use App\Service;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;


class ComputerController extends Controller
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
    public function create(User $user)
    {
        $os = ['Windows', 'Linux', 'MacOS', 'BSD', 'Other'];
        return view('admin.computer.create', compact('user', 'os'));
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
            'friendly_name' => 'required',
            'processor' => 'required',
            'graphics' => 'required',
            'ram' => 'required|numeric',
            'storage' => 'required|numeric',
            'os' => 'numeric|required',
            'user_id' => 'numeric|required'
        ]);

        $computer = Computer::create(request()->all());

        return redirect()->route('admin.computer.show', $computer)->with('status', 'Computer successfully created.');;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Computer  $computer
     * @return \Illuminate\Http\Response
     */
    public function show(Computer $computer)
    {
        $services = Service::where('computer_id', '=', $computer->id)->latest()->paginate(5);
        return view('admin.computer.show', compact('computer', 'services'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Computer  $computer
     * @return \Illuminate\Http\Response
     */
    public function edit(Computer $computer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Computer  $computer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Computer $computer)
    {
        $computer->inspection = !$computer->inspection;
        $computer->save();
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Computer  $computer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Computer $computer)
    {
        //
    }
}
