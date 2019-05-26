<?php

namespace App\Http\Controllers;

use App\Motorcycle;
use Illuminate\Http\Request;

class MotorcycleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $motorcycles = Motorcycle::all();

        return view("/motorcycles/index", compact("motorcycles"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Motorcycle $motorcycle)
    {
        $this->authorize("update" , $motorcycle);

        return view("/motorcycles/create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Motorcycle $motorcycle)
    {
        $this->authorize("update" , $motorcycle);

        request()->validate([
          "make" => ["required", "min:3"],
          "model" => ["required", "min:3"],
          "year" => ["required", "min:4"],
        ]);

        Motorcycle::create([
          "make" => $request["make"],
          "model" => $request["model"],
          "year" => $request["year"],
        ]);

        return redirect("/motorcycles");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Motorcycle  $motorcycle
     * @return \Illuminate\Http\Response
     */
    public function show(Motorcycle $motorcycle)
    {
        $categories = $motorcycle->categories;

        return view("/motorcycles/show", compact("motorcycle", "categories"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Motorcycle  $motorcycle
     * @return \Illuminate\Http\Response
     */
    public function edit(Motorcycle $motorcycle)
    {
        $this->authorize("update" , $motorcycle);

        return view("/motorcycles/edit", compact("motorcycle"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Motorcycle  $motorcycle
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Motorcycle $motorcycle)
    {
        $this->authorize("update" , $motorcycle);

        request()->validate([
          "make" => ["required", "min:3"],
          "model" => ["required", "min:3"],
          "year" => ["required", "min:4"],
        ]);

        $motorcycle->update([
          "make" => $request["make"],
          "model" => $request["model"],
          "year" => $request["year"],
        ]);

        return redirect("/motorcycles");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Motorcycle  $motorcycle
     * @return \Illuminate\Http\Response
     */
    public function destroy(Motorcycle $motorcycle)
    {
        $this->authorize("update" , $motorcycle);
        $motorcycle->delete();

        return redirect("/motorcycles");
    }
}
