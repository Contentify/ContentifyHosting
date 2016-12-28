@extends('layouts.backend')

@section('pageType', 'datatables')
@section('pageName', '<a href="'.route('server.create').'" class="btn btn-success">Create Serveur</a>')

@section('styles')
    @parent
    
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/backend/css/vendor/select2.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/backend/css/vendor/select2-bootstrap.css') }}" />
@stop


@section('scripts')
    @parent
    
    <script src="{{ asset('assets/backend/js/vendor/select2.full.min.js') }}"></script>
@stop




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

		@if(isset($server))
			{!! Form::model($server, ['route' => ['server.update', $server], 'method' => 'PATCH', 'id' => 'new-product', 'class' => 'form-horizontal']) !!}
		@else
			{!! Form::open(array('route' => 'server.store', 'method' => 'POST', 'id' => 'new-product', 'class' => 'form-horizontal')) !!}
		@endif

			<div class="form-group">
				{!! Form::label('name', 'Name:', array('class' => 'col-sm-2 col-md-2 control-label')) !!}
				<div class="col-sm-10 col-md-8">
					{!! Form::text('name', null, array('class' => 'form-control', 'placeholder' => 'Name of server')) !!}
				</div>
			</div>

			@if(isset($server))

				<div class="form-group">
					{!! Form::label('tags', 'Tags:', array('class' => 'col-sm-2 col-md-2 control-label')) !!}
					<div class="col-sm-10 col-md-8">
						{!! Form::select('tags', App\Server::makeOptionArray('tags'), $server->tags, array('class' => 'form-control tags', 'multiple' => 'multiple', 'name' => 'tags[]')) !!}
					</div>
				</div>


				<div class="form-group">
					{!! Form::label('ip', 'Ip:', array('class' => 'col-sm-2 col-md-2 control-label')) !!}
					<div class="col-sm-10 col-md-8">
						{!! Form::text('ip', null, array('class' => 'form-control', 'readonly' => 'true')) !!}
					</div>
				</div>

				<div class="form-group">
					{!! Form::label('user', 'User:', array('class' => 'col-sm-2 col-md-2 control-label')) !!}
					<div class="col-sm-10 col-md-8">
						{!! Form::select('user_id', $server->users(), $server->user->id, ['class' => 'form-control']) !!}
					</div>
				</div>

				<div class="form-group">
					{!! Form::label('provider', 'Provider:', array('class' => 'col-sm-2 col-md-2 control-label')) !!}
					<div class="col-sm-10 col-md-8">
						{!! Form::select('provider_id', $server->providers(), $server->provider->id, ['class' => 'form-control']) !!}
					</div>
				</div>
				

				<div class="form-group">
					{!! Form::label('datacenter', 'Datacenter:', array('class' => 'col-sm-2 col-md-2 control-label')) !!}
					<div class="col-sm-10 col-md-8">
						{!! Form::select('datacenter_id', $server->datacenters(), $server->datacenter->id, ['class' => 'form-control provider']) !!}
					</div>
				</div>
			@else

				<div class="form-group">
					{!! Form::label('tags', 'Tags:', array('class' => 'col-sm-2 col-md-2 control-label')) !!}
					<div class="col-sm-10 col-md-8">
						{!! Form::select('tags', App\Server::makeOptionArray('tags'), null, array('class' => 'form-control tags', 'multiple' => 'multiple', 'name' => 'tags[]')) !!}
					</div>
				</div>

				<div class="form-group">
					{!! Form::label('user', 'User:', array('class' => 'col-sm-2 col-md-2 control-label')) !!}
					<div class="col-sm-10 col-md-8">
						{!! Form::select('user_id', $users, null, ['class' => 'form-control']) !!}
					</div>
				</div>

				<div class="form-group">
					{!! Form::label('provider', 'Provider:', array('class' => 'col-sm-2 col-md-2 control-label')) !!}
					<div class="col-sm-10 col-md-8">
						{!! Form::select('provider_id', $providers, null, ['class' => 'form-control provider']) !!}
					</div>
				</div>
				

				<div class="form-group datacenter"></div>

			@endif

			<div class="form-group">
				{!! Form::label('description', 'Description:', array('class' => 'col-sm-2 col-md-2 control-label')) !!}
				<div class="col-sm-10 col-md-8">
					{!! Form::textarea('description', null, array('class' => 'form-control', 'placeholder' => 'Description')) !!}
				</div>
			</div>

			<div class="form-group form-actions">
				<div class="col-sm-offset-2 col-sm-10 col-md-offset-2 col-md-10">
					{{ link_to_route('server.index', 'Cancel', null, array('class' => 'btn btn-default')) }}
				    {!! Form::submit('Save', array('class' => 'btn btn-success')) !!}
			    </div>
			</div>
		
		{!! Form::close() !!}
				
	</div>

	<script type="text/javascript">
		$(document).ready(function() {
			$.fn.select2.defaults.set("width", "100%");
			$("#tags").select2({
				tags: true,
				placeholder: 'Select tags or add new ones',
				tokenSeparators: [",", " "],
				multiple: true,
			});

			function Datacenter() {
				var providerId = $('.provider').val();
				console.log(providerId);
				var baseUrl = '{!! url('/') !!}'
				var url = baseUrl + '/backend/server/' + providerId + '/datacenter'
				$('.datacenter').html();
				$.get(url, function(data){
					$('.datacenter').html('<label for="datacenter" class="col-sm-2 col-md-2 control-label">Datacenter:</label><div class="col-sm-10 col-md-8"><select id="datacenter_id" class="form-control" name="datacenter_id"></select></div>')
					$.each(data, function (i, item) {
					    $('#datacenter_id').append($('<option>', { 
					        value: item.id,
					        text : item.code + ' - ' + item.name
					    }));
					});
				});
			}

			$(Datacenter)

			$(".provider").on('change', function() {
				$(Datacenter)
			});
		});
	</script>
@endsection