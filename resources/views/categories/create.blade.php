@extends('layouts.app')
@section('content')

    <div class="col-xs-2">
        @if(Session::has('msg'))
            <div class="alert alert-success">
                {{ Session('msg') }}
            </div>
        @endif
        <form method="POST" action="/categories">
            {{ csrf_field()}}
            <label for="ex1">Add Category</label>
            <input class="form-control" id="add_cat" name="title" type="text">
            @if ($errors->has('title'))
                <div style="color:red">{{ $errors->first('title') }}</div>
            @endif
            <button type="submit" class="btn btn-default">Add</button>
        </form>
    </div>
    
@endsection