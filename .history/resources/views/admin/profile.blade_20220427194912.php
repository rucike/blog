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
    <div class="panel panel-default sm:rounded-lg mt-2 p-2" style="background-color:#f2f2f2;">
        <div class="panel-heading underline mb-2"><h3>{{ __('Latest Posts') }}</h3></div>
        <div class="panel-body ml-3">
            @if(!empty($latest_posts))
                @foreach($latest_posts as $latest_post)
                    <p>
                        <strong><a href="{{ url('/'.$latest_post->slug) }}" class="mr-2">{{ $latest_post->title }}</a></strong>
                        <span class="well-sm">On {{ $latest_post->created_at->format('M d,Y \a\t h:i a') }}</span>
                    </p>
                @endforeach
            @else
                <p>{{ __('You have not written any post till now') }}.</p>
            @endif
        </div>
    </div>
    <div class="panel panel-default sm:rounded-lg mt-2 p-2 bg-white">
        <div class="panel-heading underline mb-2"><h3>Latest Comments</h3></div>
        <div class="list-group">

            @if(!empty($latest_comments[0]))
                @foreach($latest_comments as $latest_comment)
                <div class="list-group-item">
                    <p class="font-weight-bold">{{ $latest_comment->body }}</p>
                    <p>On {{ $latest_comment->created_at->format('M d,Y \a\t h:i a') }}</p>
                    <p>On post <a class="font-italic" href="{{ url('/'.$latest_comment->post->slug) }}">{{ $latest_comment->post->title }}</a></p>
                </div>
                @endforeach
            @else
                <div class="list-group-item">
                    <p>You have not commented till now. Your latest 5 comments will be displayed here</p>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
@endsection