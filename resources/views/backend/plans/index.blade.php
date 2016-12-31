@extends('layouts.backend')

@section('pageType', 'datatables')
@section('pageName', '<a href="'.route('plan.create').'" class="btn btn-success">Create Plan</a>')

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
    @if(!($plans->isEmpty()))
        <table id="datatable-plans">
            <thead>
                <tr>
                    <th tabindex="0" rowspan="1" colspan="1">Id</th>
                    <th tabindex="0" rowspan="1" colspan="1">Name</th>
                    <th tabindex="0" rowspan="1" colspan="1">Provider Name</th>
                    <th tabindex="0" rowspan="1" colspan="1">Braintree Id</th>
                    <th tabindex="0" rowspan="1" colspan="1">Price</th>
                    <th tabindex="0" rowspan="1" colspan="1">Recurring</th>
                    <th tabindex="0" rowspan="1" colspan="1">Description</th>
                    <th tabindex="0" rowspan="1" colspan="1">Published</th>
                    <th tabindex="0" rowspan="1" colspan="1">Created</th>
                    <th tabindex="0" rowspan="1" colspan="1">Actions</th>
                </tr>
            </thead>

            <tbody>
                @foreach($plans as $plan)
                    <tr>
                        <td>
                            <a href="{{ url('backend/plan/'.$plan->id) }}">#{{ $plan->id }}</a>
                        </td>
                        <td>
                            <a href="{{ url('backend/plan/'.$plan->id) }}">{{ $plan->name }}</a>
                        </td>
                        <td>
                            <a href="{{ url('backend/provider/'.$plan->provider->id) }}">{{ $plan->provider->name }}</a>
                        </td>
                        <td>{{ $plan->braintree_id }}</td>
                        <td>{{ $plan->amount }} €</td>
                        <td>Every {{ $plan->interval }} Month(s)</td>
                        <td>{{ $plan->description }}</td>
                        <td>{{ $plan->published }}</td>
                        <td>{{ $plan->created_at }}</td>
                        <td class="actions">
                            <span class="delete">
                                {!! Form::open(['method' => 'DELETE', 'route' => ['plan.destroy', $plan->id]]) !!}
                                    {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                                {!! Form::close() !!}
                            </span>

                            <span class="edit">
                                <a href="{{ route('plan.edit', $plan->id) }}" class="btn btn-warning">Edit</a>
                            </span>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <div class="panel panel-default">
            <div class="panel-body">
                There are no plan at the moment.
                <a href="{{ route('plan.create') }}" class="btn btn-warning">Create Plan</a>
            </div>
        </div>
    @endif
</div>

<script type="text/javascript">
    $(function() {
        $('#datatable-plans').dataTable({
            "sPaginationType": "full_numbers",
            "iDisplayLength": 20,
            "aLengthMenu": [[20, 50, 100, -1], [20, 50, 100, "All"]]
        });
    });
</script>
@endsection