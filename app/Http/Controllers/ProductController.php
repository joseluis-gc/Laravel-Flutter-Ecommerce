<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $product = Product::all();
        return view('product.index', compact('product'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = Category::all();
        return view('product.create', compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $product = new Product();
        $product->name = $request->input('product_name');
        $product->price = $request->input('product_price');
        $product->discount = $request->input('product_discount');
        $product->category_id = $request->input('product_category');
        $product->is_hot_product = $request->input('ishot') ? true : false;
        $product->is_new_product = $request->input('isnew') ? true : false;
        $product->photo = "";
        $product->user_id = 0;
        if($product->save()){

            $photo = $request->file('product_photo');
            if($photo != null){
                $ext = $photo->getClientOriginalExtension();
                $filename = rand() . '.' . $ext;
                if($ext == 'jpg' || $ext == 'png'){
                    if($photo->move(public_path(), $filename)){
                        $product = Product::find($product->id);
                        $product->photo = url('/') . '/' . $filename;
                        $product->save();
                    }
                }
            }
            return redirect()->back()->with('success', 'Product saved successfully');
        }
        return redirect()->back()->with('failed', 'Product couldnt be saved');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::find($id);
        $categories = Category::all();
        return view('product.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $product = Product::find($id);
        $product->name = $request->input('product_name');
        $product->price = $request->input('product_price');
        $product->discount = $request->input('product_discount');
        $product->category_id = $request->input('product_category');
        $product->is_hot_product = $request->input('ishot') ? true : false;
        $product->is_new_product = $request->input('isnew') ? true : false;
        //$product->photo = "";
        $product->user_id = 0;
        if($product->save()){

                if($request->file('product_photo') != null){

                $photo = $request->file('product_photo');
                if($photo != null){
                    $ext = $photo->getClientOriginalExtension();
                    $filename = rand() . '.' . $ext;
                    if($ext == 'jpg' || $ext == 'png'){
                        if($photo->move(public_path(), $filename)){
                            $product = Product::find($product->id);
                            $product->photo = url('/') . '/' . $filename;
                            $product->save();
                        }
                    }
                }
            }

            return redirect()->back()->with('success', 'Product saved successfully');
        }
        return redirect()->back()->with('failed', 'Product couldnt be saved');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(Product::destroy($id)){
            return redirect()->back()->with('success', 'Product deleted successfuly.');
        }
        return redirect()->back()->with('deleted', 'Could not delete product.');

    }
}
