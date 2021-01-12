<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Computer;

class HomeController extends Controller
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $computers = Computer::where('user_id', auth()->user()->id)->paginate(15);
        return view('home', compact('computers'));
    }
}
