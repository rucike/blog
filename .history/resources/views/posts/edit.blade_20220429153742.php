
    @extends('posts.layout')
    
    @section('title')
        {{ __('Edit Post') }}
    @endsection


<x-app-layout>
    @section('content')

    @if (Session::has('message'))
        <div class="flash alert-info p-2 m-2">
            <p class="panel-body">
                {{ Session::get('message') }}
            </p>
      </div>
    @endif

    <script type="text/javascript" src="{{ asset('/js/tinymce/tinymce.min.js') }}"></script>
    <script type="text/javascript">
    tinymce.init({
        selector : "textarea",
        plugins : ["advlist autolink lists link image media charmap print preview anchor", "searchreplace visualblocks code fullscreen", "insertdatetime media table contextmenu paste jbimages", 'quickbars'],
        toolbar : "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image jbimages | quickimage",
    });
    </script>

    <form method="post" action='{{ url("/update") }}'>
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" name="post_id" value="{{ $post->id }}{{ old('post_id') }}">
        <div class="form-group">
            <input required="required" placeholder="Enter title here" type="text" name = "title" class="form-control" value="@if(!old('title')){{$post->title}}@endif{{ old('title') }}"/>
        </div>
        <div class="form-group">
            <textarea name='body'class="form-control">
                @if(!old('body'))
                    {!! $post->body !!}
                @endif
                {!! old('body') !!}
            </textarea>
        </div>
        <div class="mt-2 mb-3 bg-white sm:rounded-lg p-2">
            <label for="type">{{ __('Choose the Type of Your Blogs') }}</label>
            
            <select id="type2" name="type" class="block mt-1 w-full" >
                <option name="blogType" value="{{ $post->type_id }}"> {{ $select }}</option>
                @foreach( $types as $type )
                    @if( $type->id != $post->type_id )
                        <option name="blogType" value="{{ $type->id }}">{{ $type->type }}</option>  
                    @endif
                @endforeach 
            </select>
        </div>
        @if($post->active == '1')
            <input type="submit" name='publish' class="btn btn-success" value = "{{ __('Update') }}"/>
        @else
            <input type="submit" name='publish' class="btn btn-success" value = "{{ __('Publish') }}"/>
        @endif
        <input type="submit" name='save' class="btn btn-info" value = "{{ __('Save Draft') }}" />
        <a href="{{  url('delete/'.$post->id.'?_token='.csrf_token()) }}" class="btn btn-danger">{{ __('Delete') }}</a>
    </form>


    
@endsection
</x-app-layout> 
