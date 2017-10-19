@extends('layouts.app')
@section('content')

@if(count($my_categories)!=0)
    <p>You have {{ count($my_categories) }} @if(count($my_categories)>1) categories. @else category. @endif </p>
@endif
@if(count($my_posts)!=0)
    <p>You have {{ count($my_posts) }} @if(count($my_posts)>1) posts. @else post. @endif </p>
@endif 

{{-- Categories --}}

<table style="width: 50px;float: left;" class="table table-striped table-bordered">
        <tr style="width: 100px;">
            <td>Title</td>
            <td>Edit</td>
            <td>Delete</td>
        </tr>
    @foreach($category as $key => $value)
            <tr>
                <td >{{ $value->title }}</td>
                <td><a href="{{url('category/'.$value->id.'/edit')}}" class="btn pull-right btn-success" >Edit</a></td> 
                <td><input type="button" value="Delete" class="btn pull-right btn-danger delete-category-button" data-id="{{$value->id}}" data-target="#deleteModal1" data-toggle="modal"></td>
            </tr>
    @endforeach
</table>

{{-- POSTS --}}

<div id="mine">
    @foreach($post as $value)
    <div class="row" style="">
        <a href="{{url('post/'.$value->id.'/edit')}}" class="btn pull-right btn-success" >Edit</a>
        <input type="button" value="Delete" class="btn pull-right btn-danger delete-post-button" data-idd="{{$value->id}}" data-target="#deleteModal" data-toggle="modal">
          <div class="span2">
              <a href="#" class="thumbnail">
                  <img width="260" height="180" src="{{url('images/'.$value->image)}}" alt="">
              </a>
          </div>
          <div class="span6"> 
                <h3>{{$value->title}}</h3>     
                <p id="p_1">{{$value->text}}</p>
                <a href="/post/{{$value->id}}">Read More</a>
                <p id="p_2">
                    #Category : {{$value->category->title}}   
                </p>
          </div>
    </div>
    @endforeach
    {{$post->links()}}
</div>

<!-- Modal Post -->
 <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteConfirmationLabel" style="z-index: 2500;">
    <div class="modal-dialog" role="document" style="z-index: 6000;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="deleteConfirmationLabel">Delete Post</h4>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete this post?</p>
            </div>
            <form action="" method="POST" id="delete_post_form">
                <input type="hidden" name="_method" value="DELETE">
                {{csrf_field()}}
                <button type="submit" class="btn btn-danger">Delete</button>
            </form>
        </div>
    </div>
</div> 

<!-- Modal Category -->

 <div class="modal fade" id="deleteModal1" tabindex="-1" role="dialog" aria-labelledby="deleteConfirmationLabel" style="z-index: 2500;">
    <div class="modal-dialog" role="document" style="z-index: 6000;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="deleteConfirmationLabel">Delete category</h4>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete this category?</p>
            </div>
            <form action="" method="POST" id="delete_category_form">
                <input type="hidden" name="_method" value="DELETE">
                {{csrf_field()}}
                <button type="submit" class="btn btn-danger">Delete</button>
            </form>
        </div>
    </div>
</div> 


<a style="margin: 10px;width: 100px;" href="{{url('/category/create')}}" class="btn btn-success btn-sm">Add Category</a><br>
<a style="margin: 10px;width: 100px;" href="{{url('/post/create')}}" class="btn btn-success btn-sm">Add Post</a>
<script  src="https://code.jquery.com/jquery-3.2.1.min.js"  integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
  crossorigin="anonymous"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $('.delete-category-button').click(function(){
            $('#delete_category_form').attr('action', '/category/' + $(this).data('id'));
        });
        $('.delete-post-button').click(function(){
            $('#delete_post_form').attr('action', '/post/' + $(this).data('idd'));
        });
          //var myP = $('#p_1');
          //myP.html(myP.text().substring(0,230));
    });
</script>

@endsection