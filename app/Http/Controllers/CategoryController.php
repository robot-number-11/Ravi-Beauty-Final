<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $publicPath = public_path("images/categories");

        $files = File::allFiles($publicPath);

        $banners = Category::all()->toArray();


        foreach ($files as $file) {

            $filename = basename($file);

            $matched = 0;

            foreach ($banners as $banner) {
                if($filename == $banner["image"]){
                    $matched = 1;
                    break;
                }
            }


            if($matched == 0){
                File::delete($file);
            }

        }

        $categories = Category::all();

        return view("admin.admin-categories" , compact("categories"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("admin.admin-category-create");

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:5000',
            'title' => 'required',
        ]);

        $image = $request->file('image');
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('images/categories'), $imageName);

        $data = Category::create([
            'title' => $request->title,
            'image' => $imageName,
        ]);

        session()->flash('success', 'Image Upload successfully');

        return redirect()->route("admin-panel");
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return view("admin.admin-category-edit" , compact("category"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $this->validate($request, [
            'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            'title' => 'required',
        ]);

        $image = $request->file('image');
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('images/categories'), $imageName);

        $category->update([
            'title' => $request->title,
            'image' => $imageName,
        ]);

        return redirect()->route("admin-panel");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route("admin-panel");
    }
}