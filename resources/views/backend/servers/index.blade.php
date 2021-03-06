@extends('layouts.backend')

@section('pageType', 'datatables')
@section('pageName', '<a href="'.route('server.create').'" class="btn btn-success">Create Serveur</a>')

@section('styles')
    @parent
    
    <link rel="stylesheet" href="{{ asset('assets/backend/css/vendor/jquery.dataTables.css') }}">
@stop


@section('scripts')
    @parent
    
    <script src="{{ asset('assets/backend/js/vendor/jquery.dataTables.min.js') }}"></script>
@stop


@section('content')
<div class="content-wrapper">
	@if(!($servers->isEmpty()))
    	<table id="datatable-servers">
            <thead>
                <tr>
                    <th tabindex="0" rowspan="1" colspan="1">Id</th>
                    <th tabindex="0" rowspan="1" colspan="1">Name</th>
                    <th tabindex="0" rowspan="1" colspan="1">Provider</th>
                    <th tabindex="0" rowspan="1" colspan="1">Datacenter</th>
                    <th tabindex="0" rowspan="1" colspan="1">Country</th>
                    <th tabindex="0" rowspan="1" colspan="1">IP</th>
                    <th tabindex="0" rowspan="1" colspan="1">Tags</th>
                    <th tabindex="0" rowspan="1" colspan="1">Created</th>
                    <th tabindex="0" rowspan="1" colspan="1">Actions</th>
                </tr>
            </thead>

            <tbody>
            	@foreach($servers as $server)
            		<tr>
    	                <td>
    	                	<a href="{{ url('backend/server/'.$server->id) }}">#{{ $server->id }}</a>
    	                </td>
                        <td>
                            <a href="{{ url('backend/server/'.$server->id) }}">{{ $server->name }}</a>
                        </td>
                        <td>
                            <a href="{{ url('backend/provider/'.$server->provider->id) }}">{{ $server->provider->name }}</a>
                        </td>
                        <td>
                            <a href="{{ url('backend/datacenter/'.$server->datacenter->id) }}">{{ $server->datacenter->name }}</a>
                        </td>
                        <td>{{ $server->datacenter->country->name }}</td>
    	                <td>{{ $server->ip }}</td>
                        <td>
                            @foreach($server->tags as $tag)
                                <span class="tags">{{ $tag }}</span>
                            @endforeach
                        </td>
    	                <td>{{ $server->created_at }}</td>
                        <td class="actions">
                            <span class="delete">
                                {!! Form::open(['method' => 'DELETE', 'route' => ['server.destroy', $server->id]]) !!}
                                    {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                                {!! Form::close() !!}
                            </span>

                            <span class="edit">
                                <a href="{{ route('server.edit', $server->id) }}" class="btn btn-warning">Edit</a>
                            </span>
                        </td>
                	</tr>
            	@endforeach
           	</tbody>
        </table>
    @else
    	<div class="panel panel-default">
	    	<div class="panel-body">
                There are no server at the moment.
	            <a href="{{ route('server.create') }}" class="btn btn-warning">Create server</a>
	        </div>
	    </div>
    @endif
</div>

<script type="text/javascript">
    $(function() {
        $('#datatable-servers').dataTable({
            "sPaginationType": "full_numbers",
            "iDisplayLength": 20,
            "aLengthMenu": [[20, 50, 100, -1], [20, 50, 100, "All"]]
        });
    });
</script>
@endsection