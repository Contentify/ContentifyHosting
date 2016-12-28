@extends('layouts.backend')

@section('pageType', 'datatables')
@section('pageName', '<a href="'.route('datacenter.create').'" class="btn btn-success">Create Datacenter</a>')

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
    @if(!($datacenters->isEmpty()))
        <table id="datatable-datacenters">
            <thead>
                <tr>
                    <th tabindex="0" rowspan="1" colspan="1">Id</th>
                    <th tabindex="0" rowspan="1" colspan="1">Name</th>
                    <th tabindex="0" rowspan="1" colspan="1">Code</th>
                    <th tabindex="0" rowspan="1" colspan="1">Provider</th>
                    <th tabindex="0" rowspan="1" colspan="1">Country</th>
                    <th tabindex="0" rowspan="1" colspan="1">Published</th>
                    <th tabindex="0" rowspan="1" colspan="1">Created</th>
                    <th tabindex="0" rowspan="1" colspan="1">Actions</th>
                </tr>
            </thead>

            <tbody>
                @foreach($datacenters as $datacenter)
                    <tr>
                        <td>
                            <a href="{{ url('backend/datacenter/'.$datacenter->id) }}">#{{ $datacenter->id }}</a>
                        </td>
                        <td>
                            <a href="{{ url('backend/datacenter/'.$datacenter->id) }}">{{ $datacenter->name }}</a>
                        </td>
                        <td>
                            <a href="{{ url('backend/datacenter/'.$datacenter->id) }}">{{ $datacenter->code }}</a>
                        </td>
                        <td>
                            <a href="{{ url('backend/provider/'.$datacenter->provider->id) }}">{{ $datacenter->provider->name }}</a>
                        </td>
                        <td>{{ $datacenter->country->name }}</td>
                        <td>{{ $datacenter->published }}</td>
                        <td class="center">{{ $datacenter->created_at }}</td>
                        <td class="actions">
                            <span class="delete">
                                {!! Form::open(['method' => 'DELETE', 'route' => ['datacenter.destroy', $datacenter->id]]) !!}
                                    {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                                {!! Form::close() !!}
                            </span>

                            <span class="edit">
                                <a href="{{ route('datacenter.edit', $datacenter->id) }}" class="btn btn-warning">Edit</a>
                            </span>
                        </td>
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

<script type="text/javascript">
    $(function() {
        $('#datatable-datacenters').dataTable({
            "sPaginationType": "full_numbers",
            "iDisplayLength": 20,
            "aLengthMenu": [[20, 50, 100, -1], [20, 50, 100, "All"]]
        });
    });
</script>
@endsection