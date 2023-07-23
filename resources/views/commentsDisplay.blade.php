
@foreach($comments as $comment)

    <div class="display-comment" @if($comment->parent_id != null) style="margin-left:40px;" @endif>

        <strong>{{ $comment->user->name }}</strong>

        <p>{{ $comment->body }}</p>

        <a href="" id="reply"></a>

        <form method="post" action="/comments/{{ $post->id }}">
            @csrf

            <div class="form-group">

                <input type="text" name="body" class="form-control" />

                <input type="hidden" name="parent_id" value="{{ $comment->id }}" />

                <button type="submit" class="btn btn-warning">Reply</button>

            </div>


        </form>

        @include('commentsDisplay', ['comments' => $comment->replies])


    </div>

@endforeach




