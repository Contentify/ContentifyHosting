@extends('layouts.backend')

@section('pageType', 'datatables')
@section('pageName', '<a href="'.route('plan.create').'" class="btn btn-success">Create Plan</a>')

@section('content')
<div class="content-wrapper">

	<table class="table">
	    <tbody>
	        <tr>
	        	<th>Id</th>
	            <td>
	            	<a href="{{ url('backend/plan/'.$plan->id) }}">#{{ $plan->id }}</a>
	            </td>
	        </tr>
	        <tr>
	          	<th>Name</th>
	            <td>
	            	<a href="{{ url('backend/plan/'.$plan->id) }}">{{ $plan->name }}</a>
	            </td>
	        </tr>
	        <tr>
	          	<th>Provider</th>
	            <td>
	            	<a href="{{ url('backend/provider/'.$plan->provider->id) }}">{{ $plan->provider->name }}</a>
	            </td>
	        </tr>
	        <tr>
	          	<th>Braintree Id:</th>
	          	<td>{{ $plan->braintree_id }}</td>
	        </tr>
			<tr>
	          	<th>Price:</th>
	          	<td>{{ $plan->amount }} €</td>
	        </tr>
	        <tr>
	        	<th>Recurring:</th>
	        	<td>Every {{ $plan->interval }} Month(s)</td>
	        </tr>
	        <tr>
	        	<th>Description:</th>
	        	<td>{{ $plan->description }}</td>
	        </tr>
	        <tr>
	        	<th>Published:</th>
	        	<td>{{ $plan->published }}</td>
	        </tr>
	        <tr>
	          	<th>Created</th>
	          	<td>{{ $plan->created_at }}</td>
	        </tr>
	        <tr class="actions">
	          	<th>Actions</th>
	          	<td>
	          		<span class="delete">
		          		{!! Form::open(['method' => 'DELETE', 'route' => ['plan.destroy', $plan->id]]) !!}
					        {!! Form::submit('Delete '.$plan->name, ['class' => 'btn btn-danger']) !!}
					    {!! Form::close() !!}
					</span>

					<span class="edit">
				    	<a href="{{ route('plan.edit', $plan->id) }}" class="btn btn-warning">Edit {{ $plan->name }}</a>
				    </span>
	          	</td>
	        </tr>
	    </tbody>
	</table>
	
</div>
@endsection