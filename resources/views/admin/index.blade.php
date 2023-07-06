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
                @forelse($posts as $post)
                    <ul>
                        <li><a href="/blogposts/{{$post->id}}">{{$post->title}}</a></li>
                    </ul>

                @empty
                    <p>Ops ! There is no post ,sorry</p>
                @endforelse
            </div>
        </div>
    </div>



@endsection
