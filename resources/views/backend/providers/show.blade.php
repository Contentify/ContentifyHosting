@extends('layouts.backend')

@section('pageType', 'datatables')
@section('pageName', '<a href="'.route('provider.create').'" class="btn btn-success">Create Provider</a>')

@section('content')
<div class="content-wrapper">
<div class="content-wrapper">

	<table class="table">
	    <tbody>
	        <tr>
	        	<th>Id</th>
	            <td>
	            	<a href="{{ url('backend/provider/'.$provider->id) }}">#{{ $provider->id }}</a>
	            </td>
	        </tr>
	        <tr>
	          	<th>Name</th>
	            <td>
	            	<a href="{{ url('backend/provider/'.$provider->id) }}">{{ $provider->name }}</a>
	            </td>
	        </tr>
	        <tr>
	          	<th>Description</th>
	            <td>
	            	<a href="{{ url('backend/provider/'.$provider->description) }}">{{ $provider->description }}</a>
	            </td>
	        </tr>
	        <tr>
	          	<th>Published</th>
	            <td>
	            	<a href="{{ url('backend/provider/'.$provider->published) }}">{{ $provider->published }}</a>
	            </td>
	        </tr>
	        <tr>
	          	<th>Created</th>
	          	<td>{{ $provider->created_at }}</td>
	        </tr>
	        <tr class="actions">
	          	<th>Actions</th>
	          	<td>
	          		<span class="delete">
		          		{!! Form::open(['method' => 'DELETE', 'route' => ['provider.destroy', $provider->id]]) !!}
					        {!! Form::submit('Delete '.$provider->name, ['class' => 'btn btn-danger']) !!}
					    {!! Form::close() !!}
					</span>

					<span class="edit">
				    	<a href="{{ route('provider.edit', $provider->id) }}" class="btn btn-warning">Edit {{ $provider->name }}</a>
				    </span>
	          	</td>
	        </tr>
	    </tbody>
	</table>
	
</div>
@endsection