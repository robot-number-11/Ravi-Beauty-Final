<?php

namespace App\Http\Controllers;

use App\Models\Brands;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class BrandsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $publicPath = public_path("images/brands");

        $files = File::allFiles($publicPath);

        $banners = Brands::all()->toArray();


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

        $brands = Brands::all();

        return view("admin.admin-brands" , compact("brands"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("admin.admin-brand-create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'image' => 'required|image|mimes:jpg,png,jpeg,gif,webp,svg|max:5000',
            'brand' => 'required',
        ]);

        $image = $request->file('image');
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('images/brands'), $imageName);

        $data = Brands::create([
            'brand' => $request->brand,
            'image' => $imageName,
        ]);

        session()->flash('success', 'Image Upload successfully');

        return redirect()->route("admin-panel");
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Brands $brand)
    {
        return view("admin.admin-brand-edit" , compact("brand"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Brands $brand)
    {
        $this->validate($request, [
            'image' => 'required|image|mimes:jpg,png,jpeg,gif,webp,svg|max:5000',
            'brand' => 'required',
        ]);

        $image = $request->file('image');
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('images/brands'), $imageName);

        $brand->update([
            'brand' => $request->brand,
            'image' => $imageName,
        ]);

        session()->flash('success', 'Image Upload successfully');

        return redirect()->route("admin-panel");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Brands $brand)
    {
        $brand->delete();
        return redirect()->route("admin-panel");
    }
}