<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use App\Models\BlogPost;
use App\Models\Image;
use App\Models\User;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct()
    {
        $this->middleware('auth')->except('index' , 'show');
    }
    public function index()
    {
        $posts = BlogPost::all();
        return view('admin.index' ,[

            'posts' => $posts,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PostRequest $request)
    {
        $validated_data=$request->validated();

        $input = $request->all();

            $input['title'] = $validated_data['title'];
            $input['body'] = $validated_data['body'];
            $input['slug']= $validated_data['title'];
            $input['user_id'] = auth()->user()->id;

        $newPost= BlogPost::create($input);

        $input = $request->all();
        if ($image = $request->file('image')) {
            $path = 'public/images/';
            $imageName = time() . "." . $image->getClientOriginalExtension();
            $image->move($path, $imageName);
            $input['image'] = "$imageName";
        }

        $input['name'] = $validated_data['title'];
        $input['blogpost_id']= $newPost->id;

         Image::create($input);




        return redirect('blogposts/' . $newPost->id);
    }

    /**
     * Display the specified resource.
     */
    public function show(BlogPost $blogpost)
    {
        return view('admin.show', [
            'post' => $blogpost,
        ]);
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(BlogPost $blogpost)
    {
        $post = $blogpost;
        return view('admin.edit' , [
            'post' => $post,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PostRequest $request, BlogPost $blogpost)
    {
        $validated_data = $request->validated();
//        $blogpost->update([
//            'title' => $validated_data['title'],
//            'body' => $validated_data['body'],
//            'slug' => $validated_data['title']
//        ]);
        $input = $request->all();
        if ($image = $request->file('image')) {
            $destinationPath = 'image/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $input['image'] = "$profileImage";
        }else{
            unset($input['image']);
        }

        $blogpost->update($input);

        return redirect('blogposts/' . $blogpost->id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BlogPost $blogpost)
    {
        $blogpost->delete();
        return redirect('/blogposts');
    }
}
