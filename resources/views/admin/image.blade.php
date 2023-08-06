@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12 pt-2">
                <div class="x_panel">
                    <div class="col-8">
                        <h1 class="display-one" style="margin-bottom:50px ">Show Image</h1>
                    </div>
                </div>
                <div class="x_content">
                    <a href="/gallery" class="btn btn-outline-primary btn-sm">Go back</a> <br>
                    <hr>
                    <div class="form-group">
                        <img src="/public/images/{{$image->image}}" width="1200px" style="margin: 10px"  >
                    </div>
                    <br>
                    <div class="form-group">
                        <form action="/gallery/{{$image->id}}" id="delete-frm" method="post">
                            @method('DELETE')
                            @csrf
                            <button class="btn btn-danger" style="margin-right:20px ">Delete</button>
                            <a href="/public/images/{{$image->image}}" download class="btn btn-success">Download</a>
                        </form>


                    </div>

                </div>
            </div>
        </div>
    </div>







@endsection
