@extends('layouts.app')

@section('content')


    <div class="container">
        <div class="row">
            <div class="col-12 pt-2">
                <a href="/blogposts" class="btn btn-outline-primary btn-sm">Go Back</a>
                <br>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <!-- image gallery -->
                    <br>
                    @if($post->image)
                        <div class="form-group">
                            <img src="/public/images/{{$post->image->image}}"  height="500px" width="900px">
                        </div>
                    @else
                        <img src="/image/HelloWorld.svg.png"  width="900px">
                    @endif
                </div>
                <br>
                <h1 class="display-one">{{ucfirst($post->title)}}</h1>
                <p>{{$post->body}}</p>
                <hr>
                <a href="/blogposts/{{$post->id}}/edit" class="btn btn-outline-primary">Edit Post</a>
                <br><br>

                <!-- comment system -->
                @include('commentsDisplay', ['comments' => $post->comments, 'blogpost_id' => $post->id])

                <h4>Add comment</h4>

                <form method="post" action="/comments/{{$post->id}}"}>

                    @csrf

                    <div class="form-group">

                        <textarea class="form-control" name="body" placeholder="Enter Your Comment"></textarea>

                        <button type="submit" class="btn btn-success" >Add Comment</button>

                    </div>

                </form>
                <hr>
                <form action="/blogposts/{{$post->id}}" id="delete-frm" method="post">
                    @method('DELETE')
                    @csrf
                    <button class="btn btn-danger">Delete Post</button>

                </form>
            </div>
        </div>
    </div>

00































@endsection
