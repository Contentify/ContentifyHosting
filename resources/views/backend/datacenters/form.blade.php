@extends('layouts.backend')

@section('pageType', 'form')
@section('pageName', '<a href="'.route('datacenter.create').'" class="btn btn-success">Create Datacenter</a>')

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

		@if(isset($datacenter))
			{!! Form::model($datacenter, ['route' => ['datacenter.update', $datacenter], 'method' => 'PATCH', 'id' => 'new-product', 'class' => 'form-horizontal']) !!}
		@else
			{!! Form::open(array('route' => 'datacenter.store', 'method' => 'POST', 'id' => 'new-product', 'class' => 'form-horizontal')) !!}
		@endif
			<div class="form-group">
				{!! Form::label('name', 'Name:', array('class' => 'col-sm-2 col-md-2 control-label')) !!}
				<div class="col-sm-10 col-md-8">
					{!! Form::text('name', null, array('class' => 'form-control', 'placeholder' => 'Name of datacenter')) !!}
				</div>
			</div>

			<div class="form-group">
				{!! Form::label('code', 'Code:', array('class' => 'col-sm-2 col-md-2 control-label')) !!}
				<div class="col-sm-10 col-md-8">
					{!! Form::text('code', null, array('class' => 'form-control', 'placeholder' => 'Name of datacenter')) !!}
				</div>
			</div>
			@if(isset($datacenter))
				<div class="form-group">
					{!! Form::label('provider', 'Provider:', array('class' => 'col-sm-2 col-md-2 control-label')) !!}
					<div class="col-sm-10 col-md-8">
						{!! Form::select('provider_id', $datacenter->providers(), $datacenter->provider->id, ['class' => 'form-control']) !!}
					</div>
				</div>
				

				<div class="form-group">
					{!! Form::label('country', 'Country:', array('class' => 'col-sm-2 col-md-2 control-label')) !!}
					<div class="col-sm-10 col-md-8">
						{!! Form::select('country_id', $datacenter->countries(), $datacenter->country->id, ['class' => 'form-control']) !!}
					</div>
				</div>
			@else

				<div class="form-group">
					{!! Form::label('provider', 'Provider:', array('class' => 'col-sm-2 col-md-2 control-label')) !!}
					<div class="col-sm-10 col-md-8">
						{!! Form::select('provider_id', $providers, null, ['class' => 'form-control']) !!}
					</div>
				</div>
				

				<div class="form-group">
					{!! Form::label('country', 'Country:', array('class' => 'col-sm-2 col-md-2 control-label')) !!}
					<div class="col-sm-10 col-md-8">
						{!! Form::select('country_id', $countries, null, ['class' => 'form-control']) !!}
					</div>
				</div>

			@endif

			<div class="form-group">
				{!! Form::label('description', 'Description:', array('class' => 'col-sm-2 col-md-2 control-label')) !!}
				<div class="col-sm-10 col-md-8">
					{!! Form::textarea('description', null, array('class' => 'form-control', 'placeholder' => 'Description')) !!}
				</div>
			</div>

			<div class="form-group">
				<div class="col-sm-offset-2 col-sm-10 col-md-offset-2 col-md-10">
					{!! Form::checkbox('published', true) !!} Published
				</div>
			</div>

			<div class="form-group form-actions">
				<div class="col-sm-offset-2 col-sm-10 col-md-offset-2 col-md-10">
					{{ link_to_route('datacenter.index', 'Cancel', null, array('class' => 'btn btn-default')) }}
				    {!! Form::submit('Save', array('class' => 'btn btn-success')) !!}
			    </div>
			</div>
		
		{!! Form::close() !!}
				
	</div>
@endsection