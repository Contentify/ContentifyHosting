@section('pageType', 'datatables')

@extends('layouts.backend')

@section('content')
<div id="datatables">
    <div class="content-wrapper">
    	@if(!($providers->isEmpty()))
    	<table id="orders-datatable">
            <thead>
                <tr>
                    <th tabindex="0" rowspan="1" colspan="1">Id</th>
                    <th tabindex="0" rowspan="1" colspan="1">Name</th>
                    <th tabindex="0" rowspan="1" colspan="1">Description</th>
                    <th tabindex="0" rowspan="1" colspan="1">Published</th>
                    <th tabindex="0" rowspan="1" colspan="1">Created</th>
                </tr>
            </thead>
            
            <tfoot>
                <tr>
                    <th rowspan="1" colspan="1">Id</th>
                    <th rowspan="1" colspan="1">Name</th>
                    <th rowspan="1" colspan="1">Description</th>
                    <th rowspan="1" colspan="1">Published</th>
                    <th rowspan="1" colspan="1">Created</th>
                </tr>
            </tfoot>
            <tbody>
            	@foreach($providers as $provider)
            		<tr>
    	                <td>
    	                	<a href="{{ url('backend/provider/'.$provider->id) }}">#{{ $provider->id }}</a>
    	                </td>
    	                <td>{{ $provider->name }}</td>
    	                <td>{{ $provider->description }}</td>
    	                <td>{{ $provider->published }}</td>
    	                <td class="center">{{ $provider->created_at }}</td>
                	</tr>
            	@endforeach
           	</tbody>
        </table>
        @else
        	<div class="panel panel-default">
    	    	<div class="panel-body">
                    There are no provider at the moment.
    	            <a href="{{ route('provider.create') }}" class="btn btn-warning">Create provider</a>
    	        </div>
    	    </div>
        @endif
    </div>
</div>
@endsection