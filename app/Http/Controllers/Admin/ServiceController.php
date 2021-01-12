<?php

namespace App\Http\Controllers\Admin;

use App\Service;
use App\Part;
use App\Computer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;

class ServiceController extends Controller
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
    public function create(Computer $computer)
    {
        // dd($computer);
        $service = Service::create([
            'cost' => 0,
            'computer_id' => $computer->id
        ]);
        $computer->inspection = 0;
        $computer->save();
        
        return redirect()->route('admin.service.show', $service);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function show(Service $service)
    {
        $parts = Part::where('service_id', '=', $service->id)->paginate(5);
        return view('admin.service.show', compact('service', 'parts'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function edit(Service $service)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Service $service)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function destroy(Service $service)
    {
        // $parts = Part::where('service_id', $service->id);
        // foreach ($parts as $part) {
        //     dd("$part");
        // }

        $computer = $service->computer;
        $service->delete();
        return redirect()->route('admin.computer.show', $computer)->withStatus('Successfully deleted.');
    }
}
