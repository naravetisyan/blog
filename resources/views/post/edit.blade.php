@extends('layouts.app')
@section('content')

    <div class="col-xs-2">
        @if(Session::has('msg'))
            <div class="alert alert-success">
                {{ Session('msg') }}
            </div>
        @endif
        <form method="POST" action="{{ url('/post/'.$post->id) }}" enctype="multipart/form-data">
            <input type="hidden" name="_method" value="PUT">
            {{ csrf_field()}}
            <label for="ex1">Edit Post</label>
            <input class="form-control" id="add_post" name="title" placeholder="Title" type="text" value="{{$post->title}}">
            <textarea style="min-width:173px; margin: 15px 0 15px 0;" name="text" class="form-control" placeholder="Text">{{$post->text}}</textarea>
            <select style="margin: 15px 0 15px 0;" class="form-control" id="sel1" name="category_id">
               {{--  <option value="{{$post->category->id}}" >{{$post->category->title}}</option> --}}
                @foreach($categories as $category)
                @if($post->category_id == $category->id)
                <option value="{{ $category->id }}" selected>
                    {{ $category->title }}
                </option>
                @else
                <option value="{{ $category->id }}">
                    {{ $category->title }}
                </option>
                @endif
                @endforeach
            </select>
            <img width="260" height="180" src="{{url('images/'.$post->image)}}" alt="">
            <input type="file" class="image" name="image">
            <button type="submit" class="btn btn-default">Update</button>
            @if ($errors->all())
                @foreach($errors->all() as $error)
                    <div style="color:red">{{ $error }}</div>
                @endforeach
            @endif
        </form>
    </div>

@endsection