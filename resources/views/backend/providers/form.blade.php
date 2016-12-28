@section('pageType', 'form-product')

@extends('layouts.backend')

@section('content')
	<div class="content-wrapper">

		@if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

		@if(isset($provider))
			{!! Form::model($provider, ['route' => ['provider.update', $provider], 'method' => 'PATCH', 'id' => 'new-product', 'class' => 'form-horizontal']) !!}
		@else
			{!! Form::open(array('route' => 'provider.store', 'method' => 'POST', 'id' => 'new-product', 'class' => 'form-horizontal')) !!}
		@endif
			<div class="form-group">
				{!! Form::label('name', 'Name:', array('class' => 'col-sm-2 col-md-2 control-label')) !!}
				<div class="col-sm-10 col-md-8">
					{!! Form::text('name', null, array('class' => 'form-control', 'placeholder' => 'Name of provider')) !!}
				</div>
			</div>

			<div class="form-group">
				{!! Form::label('description', 'Description:', array('class' => 'col-sm-2 col-md-2 control-label')) !!}
				<div class="col-sm-10 col-md-8">
					{!! Form::textarea('description', null, array('class' => 'form-control', 'placeholder' => 'Description')) !!}
				</div>
			</div>

			<div class="form-group">
				<div class="col-sm-offset-2 col-sm-10 col-md-offset-2 col-md-10">
					{!! Form::checkbox('published', true, array('class' => 'form-control')) !!} Published
				</div>
			</div>

			<div class="form-group form-actions">
				<div class="col-sm-offset-2 col-sm-10 col-md-offset-2 col-md-10">
					{{ link_to_route('provider.index', 'Cancel', null, array('class' => 'btn btn-default')) }}
				    {!! Form::submit('Save', array('class' => 'btn btn-success')) !!}
			    </div>
			</div>
		
		{!! Form::close() !!}
				
	</div>
@endsection