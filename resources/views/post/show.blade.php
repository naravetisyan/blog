@extends('layouts.app')
@section('content')
  <div id="mine">
    <div class="row" style="">
      <a href="{{url('post/'.$post->id.'/edit')}}" class="btn pull-right btn-success" >Edit</a>
      <input type="button" value="Delete" class="btn pull-right btn-danger delete-post-button" data-idd="{{$post->id}}" data-target="#deleteModal" data-toggle="modal">
      <div class="span2">
        <a href="#" class="thumbnail">
          <img width="260" height="180" src="{{url('images/'.$post->image)}}" alt="">
        </a>
      </div>
      <div class="span6"> 
        <h3>{{$post->title}}</h3>     
        <p class="p_1">{{$post->text}}</p>
        <p id="p_2">
        #Category : {{$post->category->title}}   
        </p>
      </div>
    </div>
  </div>
@endsection