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

        if ($request->hasFile('images')) {
            $images = $request->file('images');
            foreach ($images as $image) {
                $path = 'public/images/';
                $imageName = time() . "." . $image->getClientOriginalExtension();
                $image->move($path, $imageName);
                $upload_image_url = "$imageName";
                Image::create([
                    'image' => $upload_image_url,
                    'name' =>$imageName ,
                    'type'=>'gallery'
                ]);
            }
        }


        return redirect('gallery/');
    }

    /**
     * Display the specified resource.
     */
    public function show(Image $image)
    {
//        return view('admin.show' , [
//            'image'=>$image,
//        ]);
    }

    public function destroy(Image $image)
    {
        $image->delete();
        return redirect('/gallery');
    }

}
