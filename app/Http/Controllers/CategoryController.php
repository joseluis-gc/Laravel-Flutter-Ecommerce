<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $category = Category::all();
        return view('category.index', compact('category'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $category = new Category();
        $category->name = $request->input('category_name');
        $category->icon = "";
        $category->user_id = 0;
        if($category->save()){

            $photo = $request->file('category_icon');
            if($photo != null){
                $ext = $photo->getClientOriginalExtension();
                $filename = rand() . '.'. $ext;
                if($ext == 'jpg' || $ext == 'png'){
                   if($photo->move(public_path(), $filename)){
                       $category = Category::find($category->id);
                       $category->icon = url('/') . '/' . $filename;
                       $category->save();
                   }
                }
            }

            return redirect()->back()->with('success', 'Category saved!');

        }
        else{

            return redirect()->back()->with('failed', 'Could not save Category');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::find($id);
        return view('category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $category = Category::find($id);
        $category->name = $request->input('category_name');
        $category->icon = "";
        $category->user_id = 0;

        if($category->save()){
            $photo = $request->file('category_icon');
            if($photo != null){
                $ext = $photo->getClientOriginalExtension();
                $filename = rand() . '.'. $ext;
                if($ext == 'jpg' || $ext == 'png'){
                   if($photo->move(public_path(), $filename)){
                       $category = Category::find($category->id);
                       $category->icon = url('/') . '/' . $filename;
                       $category->save();
                   }
                }
            }

            return redirect()->back()->with('success', 'Category updated!');

        }
        else{

            return redirect()->back()->with('failed', 'Could not save Category');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(Category::destroy($id)){
            return redirect()->back()->with('deleted', 'Category deleted successfuly.');
        }
        return redirect()->back()->with('delete-failed', 'Couldnt delete category.');
    }
}
