<?php

namespace App\Http\Controllers;

use App\Models\AboutUs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class AboutUsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $publicPath = public_path("images/about-us");

        $files = File::allFiles($publicPath);

        $banners = AboutUs::all()->toArray();


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

        $about = AboutUs::all();

        return view("admin.admin-aboutus" , compact("about"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("admin.admin-aboutus-create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'image' => 'required|image|mimes:jpg,png,jpeg,gif,webp,svg|max:5000',
            'title' => 'required',
            'description' => 'required',
        ]);

        $image = $request->file('image');
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('images/about-us'), $imageName);

        AboutUs::create([
            'title' => $request->title,
            'image' => $imageName,
            'description' => $request->description
        ]);

        session()->flash('success', 'Image Upload successfully');

        return redirect()->route("admin-panel");
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AboutUs $about)
    {
        return view("admin.admin-aboutus-edit" , compact("about"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, AboutUs $about)
    {
        $this->validate($request, [
            'image' => 'required|image|mimes:jpg,png,jpeg,gif,webp,svg|max:5000',
            'title' => 'required',
            'description' => 'required',
        ]);

        $image = $request->file('image');
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('images/about-us'), $imageName);

        $about->update([
            'title' => $request->title,
            'image' => $imageName,
            'description' => $request->description
        ]);

        session()->flash('success', 'Image Upload successfully');

        return redirect()->route("admin-panel");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AboutUs $about)
    {
        $about->delete();
        return redirect()->route("admin-panel");
    }
}