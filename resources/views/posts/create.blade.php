@extends('layouts.app')
@section('content')

    <div class="col-xs-2">
        @if(Session::has('msg'))
            <div class="alert alert-success">
                {{ Session('msg') }}
            </div>
        @endif
        <form method="POST" action="/posts" enctype="multipart/form-data">
            {{ csrf_field()}}
            <label for="ex1">Add Post</label>
            <input class="form-control" id="add_post" name="title" placeholder="Title" type="text">
            <textarea style="min-width:173px; margin: 15px 0 15px 0;" name="text" class="form-control" placeholder="Text"></textarea>
            <select style="margin: 15px 0 15px 0;" class="form-control" id="sel1" name="category_id">
                <option value="" >Select Category</option>
                @foreach($categories as $key => $value)
                    <option value="{{ $value['id'] }}">{{ $value['title'] }}</option>
                @endforeach
            </select>
            @foreach($categories as $value)
                <input type="hidden" name="user_id" value="{{ $value['user_id'] }} "/>
            @endforeach
            <input type="file" class="image" name="image">
            <button type="submit" class="btn btn-default">Add</button>
            @if ($errors->all())
                @foreach($errors->all() as $error)
                    <div style="color:red">{{ $error }}</div>
                @endforeach
            @endif
        </form>
    </div>
    
@endsection