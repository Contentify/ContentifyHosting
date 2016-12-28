@section('pageType', 'datatables')

@extends('layouts.backend')

@section('content')
<div class="content-wrapper">
	{{ $server }}

    {!! Form::open(['method' => 'DELETE', 'route' => ['server.destroy', $server->id]]) !!}
        {!! Form::submit('Delete '.$server->name, ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}

    <a href="{{ route('server.edit', $server->id) }}" class="btn btn-warning">Edit {{ $server->name }}</a>
</div>
@endsection