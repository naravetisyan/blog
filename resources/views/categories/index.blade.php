@extends('layouts.app')
@section('content')

	<div style="margin-left: 25px;" >
		<h2>My Categories </h2>
	    <table style="width: 150px;float: left;" class="table table-striped table-bordered">
	        <tr style="width: 120px;">
	            <td>Title</td>
	            <td>Edit</td>
	            <td>Delete</td>
	        </tr>
		    @foreach($categories as $key => $value)
	            <tr>
	                <td >{{ $value->title }}</td>
	                <td><a href="{{url('categories/'.$value->id.'/edit')}}" class="btn pull-right btn-success" >Edit</a></td> 
	                <td><input type="button" value="Delete" class="btn pull-right btn-danger delete-category-button" data-id="{{$value->id}}" data-target="#deleteModal1" data-toggle="modal"></td>
	            </tr>
		    @endforeach
		</table>
	</div>
	
@endsection