@extends('layouts.backend')

@section('pageType', 'datatables')
@section('pageName', '<a href="'.route('provider.create').'" class="btn btn-success">Create Provider</a>')

@section('styles')
    @parent
    
    <link rel="stylesheet" href="{{ asset('assets/backend/css/vendor/jquery.dataTables.css') }}">
@stop


@section('scripts')
    @parent
    
    <script src="{{ asset('assets/backend/js/vendor/jquery.dataTables.min.js') }}"></script>
@stop

@section('content')
<div id="datatables">
    <div class="content-wrapper">
    	@if(!($providers->isEmpty()))
    	<table id="datatable-providers">
            <thead>
                <tr>
                    <th tabindex="0" rowspan="1" colspan="1">Id</th>
                    <th tabindex="0" rowspan="1" colspan="1">Name</th>
                    <th tabindex="0" rowspan="1" colspan="1">Description</th>
                    <th tabindex="0" rowspan="1" colspan="1">Published</th>
                    <th tabindex="0" rowspan="1" colspan="1">Created</th>
                    <th tabindex="0" rowspan="1" colspan="1">Actions</th>
                </tr>
            </thead>
            
            <tbody>
            	@foreach($providers as $provider)
            		<tr>
    	                <td>
    	                	<a href="{{ url('backend/provider/'.$provider->id) }}">#{{ $provider->id }}</a>
    	                </td>
    	                <td>{{ $provider->name }}</td>
    	                <td>{{ $provider->description }}</td>
    	                <td>{{ $provider->published }}</td>
    	                <td>{{ $provider->created_at }}</td>
                        <td class="actions">
                            <span class="delete">
                                {!! Form::open(['method' => 'DELETE', 'route' => ['provider.destroy', $provider->id]]) !!}
                                    {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                                {!! Form::close() !!}
                            </span>

                            <span class="edit">
                                <a href="{{ route('provider.edit', $provider->id) }}" class="btn btn-warning">Edit</a>
                            </span>
                        </td>
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

<script type="text/javascript">
    $(function() {
        $('#datatable-providers').dataTable({
            "sPaginationType": "full_numbers",
            "iDisplayLength": 20,
            "aLengthMenu": [[20, 50, 100, -1], [20, 50, 100, "All"]]
        });
    });
</script>
@endsection