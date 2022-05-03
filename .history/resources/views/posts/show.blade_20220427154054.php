<x-app-layout>
    @extends('posts.layout')
    @section('title')
        @if($post)
            {{ $post->title }}
            @if(!Auth::guest() && ($post->author_id == Auth::user()->id || Auth::user()->is_admin()))
            <button class="btn mt-3 mr-3" style="float:right; background-color:#d279a6;"><a href="{{ url('edit/'.$post->slug) }}">Edit Post</a></button>
            @endif
        @else
        
            Page does not exist
        @endif
    @endsection

@section('title-meta')
    <p class="p-2">{{ $post->created_at->format('M d,Y \a\t h:i a') }} By <a class="font-italic" href="{{ url('/user/'.$post->author_id)}}">{{ $post->author->name }}</a></p>
@endsection

@section('content')
    @if($post)
        <div class="bg-white sm:rounded-lg p-2">
            {!! $post->body !!}
        </div> 
        <div style="background-color:#f2f2f2;" class="mt-3">   
            <div>
                <h2>Leave a comment</h2>
            </div>
            @if(Auth::guest())
                <p>Login to Comment</p>
            @else
                <div class="panel-body">
                    <form method="post" action="{{ url('/comment/add') }}">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="on_post" value="{{ $post->id }}">
                        <input type="hidden" name="slug" value="{{ $post->slug }}">
                        <div class="form-group">
                        <textarea required="required" placeholder="Enter comment here" name = "body" class="form-control"></textarea>
                        </div>
                        <input type="submit" name='post_comment' class="btn btn-success" value = "Post"/>
                    </form>
                </div>
            @endif
            <div>
                @if($comments)
                    <ul style="list-style: none; padding: 0">
                @foreach($comments as $comment)
                    <li class="panel-body">
                        <div class="list-group">
                            <div class="list-group-item">
                            <h3>{{ $comment->author->name }}</h3>
                            <p>{{ $comment->created_at->format('M d,Y \a\t h:i a') }}</p>
                            </div>
                            <div class="list-group-item">
                            <p>{{ $comment->body }}</p>
                            </div>
                        </div>
                    </li>
                @endforeach
                </ul>
                @endif
            </div>
        </div>
    @else
    404 error
    @endif
</x-app-layout>
@endsection