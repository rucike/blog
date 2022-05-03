<x-app-layout>
@extends('posts.layout')

@section('title')
    {{ $user->name }}
@endsection

@section('content')
    <div>
        <ul class="list-group">
            <li class="list-group-item">
                {{ __('Joined on') }}: {{$user->created_at->format('Y-m-d, H:i') }}
            </li>
            <li class="list-group-item panel-body" style="background-color:#f2f2f2;">
                <table class="table-padding">
                    <style>
                        .table-padding td{
                            padding: 3px 8px;
                        }
                    </style>
                    <tr>
                    <td>{{ __('Total Posts') }}:</td>
                    <td> {{$posts_count}}</td>
                    @if($author && $posts_count)
                    <td><a href="{{ url('/my-all-posts')}}" class="btn" style="background-color:#c2c2f0;">{{ __('Show All') }}</a></td>
                    @endif
                    </tr>
                    <tr>
                    <td>{{ __('Published Posts') }}:</td>
                    <td>{{$posts_active_count}}</td>
                    @if($posts_active_count)
                    <td><a href="{{ url('/user/'.$user->id.'/posts')}}" class="btn" style="background-color:#c2c2f0;">{{ __('Show All') }}</a></td>
                    @endif
                    </tr>
                    <tr>
                    <td>{{ __('Posts in Draft') }}:</td>
                    <td>{{$posts_draft_count}}</td>
                    @if($author && $posts_draft_count)
                    <td><a href="{{ url('my-drafts')}}" class="btn" style="background-color:#c2c2f0;">{{ __('Show All') }}</a></td>
                    @endif
                    </tr>
                </table>
            </li>
            <li class="list-group-item">
                {{ __('Total Comments') }}: {{$comments_count}}
            </li>
        </ul>
    </div>
    <div class="panel panel-default sm:rounded-lg mt-2 p-3" style="background-color:#f2f2f2;">
        <div class="panel-heading underline mb-2"><h3>{{ __('Latest Posts') }}</h3></div>
        <div class="panel-body ml-3">
            @if(!empty($latest_posts[0]))
                @foreach($latest_posts as $latest_post)
                    <a href="{{ url('/'.$latest_post->slug) }}" class="mr-2 font-weight-bold">{{ $latest_post->title }}</a><br>
                    <span class="well-sm font-italic">{{ __('Published') }}: {{ $latest_post->created_at->format('Y-m-d, H:i') }}</span><hr>
                @endforeach
            @else
                <p>{{ __('You have not written any post till now') }}.</p>
            @endif
        </div>
    </div>
    <div class="panel panel-default sm:rounded-lg mt-2 p-3 bg-white">
        <div class="panel-heading underline mb-2"><h3>{{ __('Latest Comments') }}</h3></div>
        <div class="list-group">

            @if(!empty($latest_comments[0]))
                @foreach($latest_comments as $latest_comment)
                <div class="list-group-item">
                    <p class="font-weight-bold">{{ $latest_comment->body }}</p>
                    <p>{{ __('Published') }}: {{ $latest_comment->created_at->format('Y-m-d, H:i') }}</p>
                    <p>{{ __('On post') }}: <a class="font-italic" href="{{ url('/'.$latest_comment->post->slug) }}">{{ $latest_comment->post->title }}</a></p>
                </div>
                @endforeach
            @else
                <div class="list-group-item">
                    <p>{{ __('You have not commented till now. Your latest 5 comments will be displayed here') }}</p>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
@endsection