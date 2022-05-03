<x-app-layout>
    @extends('posts.layout')

    @section('title')
        {{ __('Add') }} {{__('New Post') }}
    @endsection


    @section('content')

    <script type="text/javascript" src="{{ asset('/js/tinymce/tinymce.min.js') }}"></script>
    <script type="text/javascript">
    tinymce.init({
        selector : "textarea",
        plugins : ["advlist autolink lists link image media charmap print preview anchor", "searchreplace visualblocks code fullscreen", "insertdatetime media table contextmenu paste jbimages", 'quickbars'],
        toolbar : "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image jbimages | quickimage",
    });
    </script>

    <form action='{{ url("/new-post") }}' method="post">
        @if (Session::has('message'))
            <div class="flash alert-info p-2 mt-2 mb-2">
                <p class="panel-body">
                    {{ Session::get('message') }}
                </p>
        </div>
        @endif
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="form-group">
            <input required="required" value="{{ old('title') }}" placeholder="{{ __('Enter title here') }}" type="text" name = "title"class="form-control" />
        </div>

        <div class="form-group">
            <textarea name='body'class="form-control">{{ old('body') }}</textarea>
        </div>

        <div class="mt-2 mb-3 bg-white sm:rounded-lg p-2">
            <label for="type">{{ __('Choose the Type of Your Blogs') }}</label>
            <select id="type" name="type" class="block mt-1 w-full">
            @foreach( $types as $type )
            
                <option value="personal">{{ __('Personal blogs') }}</option>
                <option value="business">{{ __('Business / corporate blogs') }}</option>
                <option value="professional">{{ __('Personal brands / professional blogs') }}</option>
                <option value="fashion">{{ __('Fashion blogs') }}</option>
                <option value="lifestyle">{{ __('Lifestyle blogs') }}</option>
                <option value="travel">{{ __('Travel blogs') }}</option>
                <option value="food">{{ __('Food blogs') }}</option>
                <option value="review">{{ __('Affiliate / Review Blogs') }}</option>
                <option value="multimedia">{{ __('Multimedia blogs') }}</option>
                <option value="news">{{ __('News blogs') }}</option>   
            </select>
            @endforeach
        </div>

        <input type="submit" name='publish' class="btn btn-success bg-success" value = "{{ __('Publish') }}"/>
        <input type="submit" name='save' class="btn btn-info" value = "{{ __('Save Draft') }}" />
   
    </form>
</x-app-layout>
@endsection
