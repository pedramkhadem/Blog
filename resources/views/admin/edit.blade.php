@extends('layouts.app')

@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="container">
        <div class="row">
            <div class="col-12 pt-2">
                <a href="/blogposts" class="btn btn-outline-primary btn-sm">Go back</a>
                <div class="border rounded mt-5 pl-4 pr-4 pt-4 pb-4">
                    <h1 class="display-8">Update Post</h1>
                    <p>Edit and submit this post</p>

                    <hr>

                    <form action="/blogposts/{{$post->id}}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div class="row">
                            <div class="control-group col-12">
                                <label for="title">Post Title</label>
                                <input type="text" id="title" class="form-control" name="title"
                                     placeholder="Enter Post Title" value="{{$post->title}}" >
                            </div>
                            <div class="control-group col-12 mt-2">
                                <label for="body">Post Body</label>
                                <textarea id="body" class="form-control" name="body" placeholder="Enter Post Body"
                                          rows="" >{{$post->body}}</textarea>
                            </div>
                            <div class="control-group col-12">
                                <strong>Image:</strong>
                                <input type="file" name="image" placeholder="Upload Image" class="form-control" >

                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="control-group col-12 text-center">
                                <button  id="btn-submit" class="btn btn-primary">
                                    Update Post
                                </button>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>

@endsection

