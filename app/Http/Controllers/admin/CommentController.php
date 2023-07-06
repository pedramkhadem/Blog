<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\BlogPost;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request , BlogPost $blogPost)
    {
        $validated_data=$request->validate([
            'body'=> 'required',
        ]);
       // $input = $request->all();
        $input = $request->all();
        $input['user_id'] = auth()->user()->id;
        $input['blogpost_id'] = $blogPost->id;


        Comment::create($input);

//        Comment::create([
//            'body' => $validated_data['body'],
//            'user_id'=>auth()->user()->id,
//            'blogpost_id' =>$blogPost->id,
//
//        ]);
        return back();
    }
}
