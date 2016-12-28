@extends('layouts.backend')

@section('pageType', 'datatables')
@section('pageName', '<a href="'.route('server.create').'" class="btn btn-success">Create Serveur</a>')

@section('content')
<div class="content-wrapper">

	<table class="table">
	    <tbody>
	        <tr>
	        	<th>Id</th>
	            <td>
	            	<a href="{{ url('backend/server/'.$server->id) }}">#{{ $server->id }}</a>
	            </td>
	        </tr>
	        <tr>
	          	<th>Name</th>
	            <td>
	            	<a href="{{ url('backend/server/'.$server->id) }}">{{ $server->name }}</a>
	            </td>
	        </tr>
	        <tr>
	          	<th>Provider</th>
	            <td>
	            	<a href="{{ url('backend/provider/'.$server->provider->id) }}">{{ $server->provider->name }}</a>
	            </td>
	        </tr>
	      	<tr>
	          	<th>Datacenter</th>
	          	<td>
	          		<a href="{{ url('backend/datacenter/'.$server->datacenter->id) }}">{{ $server->datacenter->name }}</a>
	          	</td>
	        </tr>
	        <tr>
	          	<th>Country</th>
	          	<td>{{ $server->datacenter->country->name }}</td>
	        </tr>
	        <tr>
	          	<th>IP</th>
	          	<td>{{ $server->ip }}</td>
	        </tr>
	        <tr>
	          	<th>Tags</th>
	          	<td>
	          		@foreach($server->tags as $tag)
                        <span class="tags">{{ $tag }}</span>
                    @endforeach
	          	</td>
	        </tr>
	        <tr>
	          	<th>Created</th>
	          	<td>{{ $server->created_at }}</td>
	        </tr>
	        <tr class="actions">
	          	<th>Actions</th>
	          	<td>
	          		<span class="delete">
		          		{!! Form::open(['method' => 'DELETE', 'route' => ['server.destroy', $server->id]]) !!}
					        {!! Form::submit('Delete '.$server->name, ['class' => 'btn btn-danger']) !!}
					    {!! Form::close() !!}
					</span>

					<span class="edit">
				    	<a href="{{ route('server.edit', $server->id) }}" class="btn btn-warning">Edit {{ $server->name }}</a>
				    </span>
	          	</td>
	        </tr>
	    </tbody>
	</table>
	
</div>
@endsection