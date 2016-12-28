@extends('layouts.backend')

@section('pageType', 'datatables')
@section('pageName', '<a href="'.route('datacenter.create').'" class="btn btn-success">Create Datacenter</a>')

@section('content')
<div class="content-wrapper">

	<table class="table">
	    <tbody>
	        <tr>
	        	<th>Id</th>
	            <td>
	            	<a href="{{ url('backend/datacenter/'.$datacenter->id) }}">#{{ $datacenter->id }}</a>
	            </td>
	        </tr>
	        <tr>
	          	<th>Name</th>
	            <td>
	            	<a href="{{ url('backend/datacenter/'.$datacenter->id) }}">{{ $datacenter->name }}</a>
	            </td>
	        </tr>
	        <tr>
	          	<th>Code</th>
	            <td>
	            	<a href="{{ url('backend/datacenter/'.$datacenter->id) }}">{{ $datacenter->code }}</a>
	            </td>
	        </tr>
	        <tr>
	          	<th>Provider</th>
	            <td>
	            	<a href="{{ url('backend/provider/'.$datacenter->provider->id) }}">{{ $datacenter->provider->name }}</a>
	            </td>
	        </tr>
	        <tr>
	          	<th>Country</th>
	          	<td>{{ $datacenter->country->name }}</td>
	        </tr>
			<tr>
	          	<th>Published</th>
	          	<td>{{ $datacenter->published }}</td>
	        </tr>
	        <tr>
	          	<th>Created</th>
	          	<td>{{ $datacenter->created_at }}</td>
	        </tr>
	        <tr class="actions">
	          	<th>Actions</th>
	          	<td>
	          		<span class="delete">
		          		{!! Form::open(['method' => 'DELETE', 'route' => ['datacenter.destroy', $datacenter->id]]) !!}
					        {!! Form::submit('Delete '.$datacenter->name, ['class' => 'btn btn-danger']) !!}
					    {!! Form::close() !!}
					</span>

					<span class="edit">
				    	<a href="{{ route('datacenter.edit', $datacenter->id) }}" class="btn btn-warning">Edit {{ $datacenter->name }}</a>
				    </span>
	          	</td>
	        </tr>
	    </tbody>
	</table>
	
</div>
@endsection