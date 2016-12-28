@section('pageType', 'datatables')

@extends('layouts.backend')

@section('content')
<div class="content-wrapper">
	@if(!($datacenters->isEmpty()))
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
        	@foreach($datacenters as $datacenter)
        		<tr>
	                <td>
	                	<a href="{{ url('backend/datacenter/'.$datacenter->id) }}">#{{ $datacenter->id }}</a>
	                </td>
	                <td>{{ $datacenter->name }}</td>
	                <td>{{ $datacenter->description }}</td>
	                <td>{{ $datacenter->published }}</td>
	                <td class="center">{{ $datacenter->created_at }}</td>
            	</tr>
        	@endforeach
       	</tbody>
    </table>
    @else
    	<div class="panel panel-default">
	    	<div class="panel-body">
                There are no datacenter at the moment.
	            <a href="{{ route('datacenter.create') }}" class="btn btn-warning">Create datacenter</a>
	        </div>
	    </div>
    @endif
</div>
@endsection