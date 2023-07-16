@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12 pt-2">
                <div class="row">
                    <div class="col-8">
                        <h1 class="display-one">Pedi Blog!</h1>
                        <p>Enjoy reading our posts. Click on a post to read! of pediblog</p>
                    </div>
                    <div class="col-4">
                        <p>Create new Post</p>
                        <a href="/blogposts/create" class="btn btn-primary btn-sm">Add Post</a>
                    </div>
                </div>

                    <table  class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Image</th>
                                <th width="500px">title</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        @forelse($posts as $post)
                            <tr>
                                <td>
                                    @if($post->image)
                                        <div class="form-group">
                                            <img src="/public/images/{{$post->image->image}}"   width="100px">
                                        </div>
                                    @else
                                        <img src="image/HelloWorld.svg.png"  width="100px">
                                    @endif
                                </td>
                                <td>{{$post->title}}</td>
                                <td>
                                    <a href="/blogposts/{{$post->id}}" class="btn btn-danger">Show Post</a>
                                </td>
                            </tr>
                        @empty
                            <p>Ops ! There is no post ,sorry</p>
                        @endforelse
                        </tbody>
                    </table>


            </div>
        </div>
    </div>



@endsection
