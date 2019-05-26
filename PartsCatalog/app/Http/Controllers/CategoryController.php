<?php

namespace App\Http\Controllers;

use App\Category;
use App\Motorcycle;
use App\Part;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Motorcycle $motorcycle)
    {

        $this->authorize("update" , $motorcycle);

        return view("/categories/create", compact("motorcycle"));
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
          "title" => ["required", "min:3"]
        ]);

        Category::create([
          "motorcycle_id" => $motorcycle->id,
          "title" => $request["title"]
        ]);

        return redirect("/motorcycles/$motorcycle->id");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Motorcycle $motorcycle, Category $category)
    {

        $this->authorize("update" , $motorcycle);

        return view("/categories/edit", compact("category", "motorcycle"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Motorcycle $motorcycle, Category $category)
    {

        $this->authorize("update" , $motorcycle);

        request()->validate([
          "title" => ["required", "min:3"]
        ]);

        $category->update([
          "motorcycle_id" => $motorcycle->id,
          "title" => $request["title"]
        ]);

        return redirect("/motorcycles/$motorcycle->id");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Motorcycle $motorcycle , Category $category)
    {

        $this->authorize("update" , $motorcycle);

        $category->delete();

        return redirect("/motorcycles/$motorcycle->id");
    }

    public function show(Motorcycle $motorcycle, Category $category)
    {

        $parts = $category->parts;

        return view("/categories/show", compact("motorcycle", "category" , "parts"));
    }

}
