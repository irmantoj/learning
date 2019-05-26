<?php

namespace App\Http\Controllers;

use App\Part;
use App\Category;
use App\Motorcycle;
use Illuminate\Http\Request;

class PartsController extends Controller
{
    public function create(Motorcycle $motorcycle, Category $category)
    {

        $this->authorize("update", $motorcycle);

        return view("/parts/create", compact("motorcycle", "category"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Motorcycle $motorcycle, Category $category)
    {

      $this->authorize("update", $motorcycle);

      request()->validate([
        "title" => ["required", "min:3"],
        "manufacturer" => ["required", "min:3"],
        "description" => ["required", "min:80"],
        "img" => ["required"],
        "price" => ["required", "numeric"],
      ]);

      Part::create([
        "category_id" => $category->id,
        "title" => $request["title"],
        "manufacturer" => $request["manufacturer"],
        "description" => $request["description"],
        "img" => $request["img"],
        "price" => $request["price"],
        "material" => $request["material"],
        "weight" => $request["weight"],
      ]);

      return redirect("/motorcycles/$motorcycle->id/category/$category->id/show");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Part  $part
     * @return \Illuminate\Http\Response
     */
    public function show(Motorcycle $motorcycle, Category $category, Part $part)
    {
        return view("/parts/show" , compact("motorcycle", "category", "part"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Part  $part
     * @return \Illuminate\Http\Response
     */
    public function edit(Motorcycle $motorcycle, Category $category, Part $part)
    {

        $this->authorize("update", $motorcycle);

        return view("/parts/edit" , compact("motorcycle", "category", "part"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Part  $part
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Motorcycle $motorcycle, Category $category, Part $part)
    {

        $this->authorize("update", $motorcycle);

        request()->validate([
          "title" => ["required", "min:3"],
          "manufacturer" => ["required", "min:3"],
          "description" => ["required", "min:80"],
          "img" => ["required"],
          "price" => ["required", "numeric"],
        ]);

        $part->update([
          "title" => $request["title"],
          "manufacturer" => $request["manufacturer"],
          "description" => $request["description"],
          "img" => $request["img"],
          "price" => $request["price"],
          "material" => $request["material"],
          "weight" => $request["weight"],
        ]);

        return redirect("/motorcycles/$motorcycle->id/category/$category->id/show/$part->id/show");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Part  $part
     * @return \Illuminate\Http\Response
     */
    public function destroy(Motorcycle $motorcycle, Category $category, Part $part)
    {

        $this->authorize("update", $motorcycle);

        $part->delete();

        return redirect("/motorcycles/$motorcycle->id/category/$category->id/show");
    }
}
