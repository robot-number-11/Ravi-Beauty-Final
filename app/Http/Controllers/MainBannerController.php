<?php

namespace App\Http\Controllers;

use App\Models\MainBanner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class MainBannerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $publicPath = public_path("images/banners");

        $files = File::allFiles($publicPath);

        $banners = MainBanner::all()->toArray();


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

        $banners = MainBanner::all();

        return view("admin.admin-banners" , compact("banners"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("admin.admin-banner-create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:5000',
            'title' => 'required',
            'description' => "required",
        ]);

        $image = $request->file('image');
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('images/banners'), $imageName);

        $data = MainBanner::create([
            'title' => $request->title,
            'image' => $imageName,
            'description' => $request->description,
        ]);

        session()->flash('success', 'Image Upload successfully');

        return redirect()->route("admin-panel");
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MainBanner $banner)
    {

        return view("admin.admin-banner-edit" , compact("banner"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, MainBanner $banner)
    {
        $this->validate($request, [
            'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            'title' => 'required',
            'description' => "required",
        ]);

        $image = $request->file('image');
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('images/banners'), $imageName);

        $banner->update([
            'title' => $request->title,
            'image' => $imageName,
            'description' => $request->description,
        ]);

        return redirect()->route("admin-panel");


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MainBanner $banner)
    {
        $banner->delete();
        return redirect()->route("admin-panel");
    }
}