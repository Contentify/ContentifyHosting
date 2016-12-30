@extends('layouts.frontend')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">{{ Auth::user()->name }}</div>

                <div class="panel-body">

                    @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif


                    {!! Form::model(Auth::user(), [
                        'method' => 'PATCH',
                        'route' => ['user.update', Auth::user()->email],
                        'files' => true
                    ]) !!}

                    <div class="form-group">
                        {!! Form::label('name', 'Name:', ['class' => 'control-label']) !!}
                        {!! Form::text('name', null, ['class' => 'form-control']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('email', 'Email:', ['class' => 'control-label']) !!}
                        {!! Form::email('email', null, ['class' => 'form-control']) !!}
                    </div>

                    {!! Form::submit('Update', ['class' => 'btn btn-primary']) !!}

                    {!! Form::close() !!}


                    {!! Form::open([
                        'method' => 'DELETE',
                        'route' => ['user.destroy', Auth::user()->email]
                    ]) !!}
                        {!! Form::submit('Delete account', ['class' => 'btn btn-danger']) !!}
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
