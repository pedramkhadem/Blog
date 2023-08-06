<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use App\Models\BlogPost;
use App\Models\Image;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $images= Image::latest()->paginate(20);
        return view('admin.gallery', compact('images'));


    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'images' => 'required',
            'images.*' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);


        $images = [];
        if ($request->images){
            foreach($request->images as $key => $image)
            {
                $imageName = time().rand(1,99).'.'.$image->extension();
                $path = 'public/images/';
                $image->move($path, $imageName);


                $images[]['name'] = $imageName;
            }
        }

        foreach ($images as $key => $image) {
            $upload_image_url = $image["name"];
            Image::create([
                'image' =>$upload_image_url,
                'type' => 'gallery'
            ]);
        }

        return redirect('gallery/')->with('success','You have successfully upload image.');

    }

    /**
     * Display the specified resource.
     */
    public function show(Image $image)
    {
        return view('admin.image' , [
        'image'=>$image,
    ]);
    }

    public function destroy(Image $image)
    {
        $image->delete();
        return redirect('/gallery')->with('delete','You have successfully deleted image.' );
    }

}
