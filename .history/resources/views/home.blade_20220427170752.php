
<x-app-layout>
    @extends('posts.layout')
    
    @section('content')

    @if (Session::has('message'))
        <div class="flash alert-info p-2 m-">
            <p class="panel-body">
                {{ Session::get('message') }}
            </p>
      </div>
    @endif

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    @section('title')
                    {{$title}}
                    @endsection
                @if ( !$posts->count() )
                    There is no post till now. Login and write a new post now!!!
                @else
                    <div class="overflow-hidden shadow-sm sm:rounded-lg" style="background-color:#e6e6e6;">
                        @foreach( $posts as $post )
                        <div class="list-group m-2">
                            <div class="list-group-item" style="background-color:#BBADA0;">
                                <h3><a href="{{ url('/'.$post->slug) }}" class="h4">{{ $post->title }}</a>
                                    @if(!Auth::guest() && ($post->author_id == Auth::user()->id || Auth::user()->is_admin()))
                                        @if($post->active == '1')
                                            <button class="btn" style="float:right; background-color:#d279a6;"><a href="{{ url('edit/'.$post->slug)}}">Edit Post</a></button>
                                        @else
                                            <button class="btn" style="float:right; background-color:#d279a6;"><a href="{{ url('edit/'.$post->slug)}}">Edit Draft</a></button>
                                        @endif
                                    @endif
                                </h3>
                                <p>{{ $post->created_at->format('M d,Y \a\t h:i a') }} By <a href="{{ url('/user/'.$post->author_id)}}">{{ $post->author->name }}</a></p>
                            </div>
                            <div class="list-group-item">
                                <article>
                                    {!! \Illuminate\Support\Str::limit($post->body, 200, $end = '....... <br><a href='.url("/".$post->slug).' class="btn mt-3" style="background-color:#ecc6d9;">Read More</a>') !!}
                                </article>
                            </div>
                        </div>
                        <hr class="mt-2 mb-2" style="background-color:#36527c">
                        @endforeach
                        <div class="m-3">
                            {!! $posts->render() !!}
                        </div>
                    </div>
                @endif
                
            </div>
        </div>
    </div>
</x-app-layout>
@endsection
