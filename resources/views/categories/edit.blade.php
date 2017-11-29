@extends('layouts.app')
@section('content')

    <div class="col-xs-2">
        @if(Session::has('msg'))
            <div class="alert alert-success">
                {{ Session('msg') }}
            </div>
        @endif
        <form method="POST" action="{{ url('/categories/'.$category->id) }}">
            {{ csrf_field()}}
            <input type="hidden" name="_method" value="PUT">
            <label for="ex1">Edit Category</label>
            <input class="form-control" id="title" value="{{$category->title}}" name="title" type="text">
            @if ($errors->has('title'))
                <div style="color:red">{{ $errors->first('title') }}</div>
            @endif
            <button type="submit" class="btn btn-default">Save</button>
        </form>
    </div>
    
@endsection