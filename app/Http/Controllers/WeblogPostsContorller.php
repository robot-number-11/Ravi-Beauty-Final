<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\WeblogPosts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Gate;

class WeblogPostsContorller extends Controller
{

    public function index()
    {
        $publicPath = public_path("images/weblog");

        $files = File::allFiles($publicPath);

        $banners = WeblogPosts::all()->toArray();


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
        $posts = WeblogPosts::paginate(3);

        return view("all-weblog-posts" , compact("posts"));

    }

    public function show(WeblogPosts $post)
    {
        return view("singel-weblog-post" , compact("post"));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create(User $user)
    {

        return view("weblog-post-create" , compact("user"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request , User $user)
    {
        $this->validate($request, [
            'image' => 'required|image|mimes:jpg,png,jpeg,gif,webp,svg|max:5000',
            'title' => 'required',
            'description' => 'required',
        ]);

        $image = $request->file('image');
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('images/weblog'), $imageName);

        $data = WeblogPosts::create([
            'title' => $request->title,
            'description' => $request->description,
            'user_id' => auth()->user()->id,
            'image' => $imageName,
        ]);

        session()->flash('success', 'Image Upload successfully');

        return redirect()->route("weblog");
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(WeblogPosts $post)
    {
        return view("weblog-post-edit" , compact("post"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, WeblogPosts $post)
    {
        $this->validate($request, [
            'image' => 'required|image|mimes:jpg,png,jpeg,gif,webp,svg|max:5000',
            'title' => 'required',
            'description' => 'required',
        ]);

        $image = $request->file('image');
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('images/weblog'), $imageName);

        $post->update([
            'title' => $request->title,
            'description' => $request->description,
            'user_id' => auth()->user()->id,
            'image' => $imageName,
        ]);

        session()->flash('success', 'Image Upload successfully');

        return redirect()->route("weblog");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(WeblogPosts $post)
    {
        $post->delete();
        return redirect()->route("weblog");
    }
}