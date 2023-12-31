@extends('layouts.app')

@section('content')
    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>
                        {{ $error }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </li>
                @endforeach
            </ul>

        </div>

    @elseif ($message = Session::get('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{ $message }}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @if($message=Session::get('delete'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{ $message }}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <div class="container">
        <div class="row">
            <div class="col-12 pt-2">
                <div class="x_panel">
                    <div class="col-8">
                    <h1 class="display-one">Image Gallery</h1>
                </div>
                    <div class="x_content">
                    <br/>
                        <a href="/blogposts" class="btn btn-outline-primary btn-sm">Go back</a> <br> <br>

                        <form action="/gallery/store" method="post" enctype="multipart/form-data"  class="form-inline">
                            <p><small>Note: Total size of uploading files shold not be greater than 2 MB.</small></p>
                        @csrf
                            <div class="col-4">
                                <input type="file" name="images[]" id="images"  accept="image/png, image/jpeg, image/jpg, image/gif"  class="form-control" multiple/>
                            </div>
                            <div class="col-4">
                                <button type="submit" class="btn btn-info" style="margin: 10px;">Upload</button>
                            </div>

                        </form>
                        <br/>
                        <div class="table-responsive">

                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>No</th>
                                <th>Image</th>
                                <th>Created at</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($images as $imgs)
                                <tr>
                                    <td>
                                        {{$loop->iteration}}
                                    </td>
                                    <td>
                                        <div class="form-group">
                                            <img src="/public/images/{{$imgs->image}}" width="200px" style="margin: 10px"  >
                                        </div>
                                    </td>
                                    <td>{{$imgs['created_at']->format('F d, Y') }}</td>
                                    <td>
                                        @if($imgs['blogpost_id'] == null)
                                            <span>Inactive</span>
                                        @else
                                            <span>Active</span>
                                        @endif
                                    </td>
                                    <td>
                                        <form action="/gallery/{{$imgs->id}}" id="delete-frm" method="post">
                                            @method('DELETE')
                                            @csrf
                                            <button class="btn btn-danger">Delete</button>
                                            <a href="/gallery/{{$imgs->id}}" class="btn btn-primary ">Show image</a>
                                            <a href="/public/images/{{$imgs->image}}" download class="btn btn-success">Download</a>

                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>

        {{$images->links()}}

    </div>

</div>
@endsection
