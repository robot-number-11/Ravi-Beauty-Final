<?php

namespace App\Http\Controllers;

use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $publicPath = public_path("images/products");

        $files = File::allFiles($publicPath);

        $products = Products::all()->toArray();


        foreach ($files as $file) {

            $filename = basename($file);

            $matched = 0;

            foreach ($products as $product) {
                if($filename == $product["image"]){
                    $matched = 1;
                    break;
                }
            }


            if($matched == 0){
                File::delete($file);
            }

        }

        $products = Products::all();

        return view("admin.admin-products" , compact("products"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("admin.admin-product-create");

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'image' => 'required|image|mimes:jpg,png,jpeg,webp,gif,svg|max:2048',
            'title' => 'required',
            'price' => "required|numeric",
            'category' => 'required'
        ]);

        $image = $request->file('image');
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('images/products'), $imageName);

        Products::create([
            'title' => $request->title,
            'image' => $imageName,
            'price' => $request->price,
            'category' => $request->category
        ]);

        return redirect()->route("admin-panel");
    }



    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Products $product)
    {
        return view("admin.admin-product-edit" , compact("product"));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Products $product)
    {
        $this->validate($request, [
            'image' => 'required|image|mimes:jpg,png,jpeg,webp,gif,svg|max:2048',
            'title' => 'required',
            'price' => "required|numeric",
            'category' => 'required'
        ]);

        $image = $request->file('image');
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('images/products'), $imageName);

        $product->update([
            'title' => $request->title,
            'image' => $imageName,
            'price' => $request->price,
            'category' => $request->category
        ]);

        return redirect()->route("admin-panel");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Products $product)
    {
        $product->delete();
        return redirect()->route("admin-panel");
    }
}