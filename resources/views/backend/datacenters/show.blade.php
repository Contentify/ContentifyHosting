@section('pageType', 'datatables')

@extends('layouts.backend')

@section('content')
<div class="content-wrapper">
	{{ $datacenter }}

    {!! Form::open(['method' => 'DELETE', 'route' => ['datacenter.destroy', $datacenter->id]]) !!}
        {!! Form::submit('Delete '.$datacenter->name, ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}

    <a href="{{ route('datacenter.edit', $datacenter->id) }}" class="btn btn-warning">Edit {{ $datacenter->name }}</a>
</div>
@endsection