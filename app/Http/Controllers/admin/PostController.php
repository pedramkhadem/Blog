<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use App\Models\BlogPost;
use App\Models\Comment;
use App\Models\Image;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Session\Store;
use function PHPUnit\Framework\isEmpty;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct()
    {
        $this->middleware('auth');
        //->except('index', 'show')
    }

    public function index()
    {
       $posts = BlogPost::paginate(20);

        return view('admin.index',compact('posts'));
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
        $newPost = BlogPost::create([
            'title' => $request->safe()->title,
            'body' => $request->safe()->body,
            'slug' => $request->safe()->title,
            'user_id' => auth()->user()->id,
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $path = 'public/images/';
            $imageName = time() . "." . $image->getClientOriginalExtension();
            $image->move($path, $imageName);
            $upload_image_url = "$imageName";
            Image::create([
                'blogpost_id' => $newPost->id,
                'image' => $upload_image_url,
                'name' => $request->safe()->title,
                'type'=>'thumbnail'
            ]);
        }
        return redirect('blogposts/' . $newPost->id);
    }

    /**
     * Display the specified resource.
     */
    public function show(BlogPost $blogpost)
    {

        $comment = $blogpost->comments()->Paginate(5);
        return view('admin.show', [
            'post' => $blogpost,
            'cm'=>$comment,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(BlogPost $blogpost)
    {
        $post = $blogpost;
        return view('admin.edit', [
            'post' => $blogpost,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PostRequest $request, BlogPost $blogpost)
    {

        $validated_data = $request->validated();
        $blogpost->update([
            'title' => $validated_data['title'],
            'body' => $validated_data['body'],
            'slug' => $validated_data['title'],
        ]);
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $path = 'public/images';
            $imageName = time() . "." . $image->getClientOriginalExtension();
            $image->move($path, $imageName);
            $upload_image_url = "$imageName";


            $blogpost->image()->updateOrCreate(
                ['blogpost_id' => $blogpost->id],
                ['image' => $upload_image_url,
                    'name' => $validated_data['title'],
                    'type'=>'thumbnail'

                ]
            );


//            if (empty($blogpost->images)) {
//                $blogpost->images()->create([
//                    'image' => $upload_image_url,
//                    'name' => $validated_data['title'],
//                    'blogpost_id' => $blogpost->id,
//                ]);
//            } else {
//                $blogpost->images()->update([
//                    'image' => $upload_image_url,
//                    'name' => $validated_data['title'],
//                ]);
//            }
        }

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
