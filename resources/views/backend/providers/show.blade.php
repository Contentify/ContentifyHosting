@section('pageType', 'datatables')

@extends('layouts.backend')

@section('content')
<div class="content-wrapper">
	{{ $provider }}

    {!! Form::open(['method' => 'DELETE', 'route' => ['provider.destroy', $provider->id]]) !!}
        {!! Form::submit('Delete '.$provider->name, ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}

    <a href="{{ route('provider.edit', $provider->id) }}" class="btn btn-warning">Edit {{ $provider->name }}</a>
</div>
@endsection