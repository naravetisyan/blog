@extends('layouts.app')
@section('content')
    @foreach($category as $value)
        <tr>
            <td>{{ $value->id }}</td>
            <td>{{ $value->title }}</td>
        </tr>
    @endforeach
@endsection