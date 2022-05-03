<x-app-layout>
    @extends('posts.layout')
    @section('title')
        @if($post)
            {{ $post->title }}
            @if(!Auth::guest() && ($post->author_id == Auth::user()->id || Auth::user()->is_admin()))
            <button class="btn mt-3 mr-3" style="float:right; background-color:#d279a6;"><a href="{{ url('edit/'.$post->slug) }}">{{ __('Edit Post') }}</a></button>
            @endif
        @else
            {{ __('Page does not exist
        @endif
    @endsection

@section('title-meta')
    <p class="p-2">{{ $post->created_at->format('Y-m-d, H:i') }} By <a class="font-italic" href="{{ url('/user/'.$post->author_id)}}">{{ $post->author->name }}</a></p>
@endsection

@section('content')
    @if($post)
        <div class="bg-white sm:rounded-lg p-2">
            {!! $post->body !!}
        </div> 
        <div style="background-color:#d9d9d9;" class="mt-3 sm:rounded-lg p-2">   
            <div class="underline mb-2">
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
                        <input type="submit" name='post_comment' class="btn mb-2" style="background-color:#d279a6;" value = "Post"/>
                    </form>
                </div>
            @endif
            <hr style="background-color:#36527c">
            <div class="mt-2">
                @if($comments)
                    <ul style="list-style: none; padding: 0">
                @foreach($comments as $comment)
                    <li class="panel-body mt-2 mb-2">
                        <div class="list-group">
                            <div class="list-group-item" style="background-color:#f2f2f2">
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