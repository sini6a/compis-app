<?php

namespace App\Http\Controllers\Admin;

use App\Part;
use App\Service;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class PartController extends Controller
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
    public function create(Service $service)
    {
        //dd($computer);
        return view('admin.part.create', compact('service'));
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
            'name' => 'required|max:128',
            'price' => 'numeric|required',
            'discount' => 'required|integer',
            'discounted_price' => 'required|numeric',
            'service_id' => 'numeric|required',
        ]);

        $part = Part::create(request()->only('name', 'price', 'discount', 'discounted_price', 'service_id'));

        $service = Service::findOrFail($part->service_id);
        $service->cost += $part->discounted_price;
        $service->save();

        return redirect()->route('admin.service.show', $part->service_id)->with('status', 'Successfully created.');;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Part  $part
     * @return \Illuminate\Http\Response
     */
    public function show(Part $part)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Part  $part
     * @return \Illuminate\Http\Response
     */
    public function edit(Part $part)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Part  $part
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Part $part)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Part  $part
     * @return \Illuminate\Http\Response
     */
    public function destroy(Part $part)
    {
        $service = Service::findOrFail($part->service_id);
        $service->cost -= $part->discounted_price;
        $service->save();

        $part->delete();

        return redirect()->route('admin.service.show', $part->service_id)->with('status', 'Successfully removed.');;
    }
}
