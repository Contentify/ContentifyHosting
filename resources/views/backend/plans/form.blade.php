@extends('layouts.backend')

@section('pageType', 'form')
@section('pageName', '<a href="'.route('plan.create').'" class="btn btn-success">Create Plan</a>')

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

		@if(isset($plan))
			{!! Form::model($plan, ['route' => ['plan.update', $plan], 'method' => 'PATCH', 'id' => 'new-product', 'class' => 'form-horizontal']) !!}
		@else
			{!! Form::open(array('route' => 'plan.store', 'method' => 'POST', 'id' => 'new-product', 'class' => 'form-horizontal')) !!}
		@endif
			<div class="form-group">
				{!! Form::label('name', 'Name:', array('class' => 'col-sm-2 col-md-2 control-label')) !!}
				<div class="col-sm-10 col-md-8">
					{!! Form::text('name', null, array('class' => 'form-control', 'placeholder' => 'Name of plan')) !!}
				</div>
			</div>

			@if(isset($plan))
				<div class="form-group">
					{!! Form::label('provider', 'Provider:', array('class' => 'col-sm-2 col-md-2 control-label')) !!}
					<div class="col-sm-10 col-md-8">
						{!! Form::select('provider_id', $plan->providers(), $plan->provider->id, ['class' => 'form-control']) !!}
					</div>
				</div>
				
			@else

				<div class="form-group">
					{!! Form::label('provider', 'Provider:', array('class' => 'col-sm-2 col-md-2 control-label')) !!}
					<div class="col-sm-10 col-md-8">
						{!! Form::select('provider_id', $providers, null, ['class' => 'form-control']) !!}
					</div>
				</div>
				
			@endif

			<div class="form-group">
				{!! Form::label('braintree_id', 'Braintree plan name:', array('class' => 'col-sm-2 col-md-2 control-label')) !!}
				<div class="col-sm-10 col-md-8">
					<select class="form-control" name="braintree_id" id="braintree_select">
						<option>Select Plan</option>
						@foreach($braintreePlans as $braintreePlan)
							<option data-price="{{ $braintreePlan->price }}" data-cycle="{{ $braintreePlan->billingFrequency }}" data-trial="{{ $braintreePlan->trialDuration }}" data-description="{{ $braintreePlan->description }}" value="{{ $braintreePlan->name }}">{{ $braintreePlan->name }} :: {{ $braintreePlan->price }} €</option>
						@endforeach
					</select>
				</div>
			</div>

			<div class="form-group">
				{!! Form::label('amount', 'Price:', array('class' => 'col-sm-2 col-md-2 control-label')) !!}
				<div class="col-sm-10 col-md-8">
					{!! Form::text('amount', null, array('class' => 'form-control', 'placeholder' => 'Select braintree plan', 'readonly')) !!}
				</div>
			</div>

			<div class="form-group">
				{!! Form::label('interval', 'Cycle:', array('class' => 'col-sm-2 col-md-2 control-label')) !!}
				<div class="col-sm-10 col-md-8">
					{!! Form::text('interval', null, array('class' => 'form-control', 'placeholder' => 'Select braintree plan', 'readonly')) !!}
				</div>
			</div>

			<div class="form-group">
				{!! Form::label('description', 'Description:', array('class' => 'col-sm-2 col-md-2 control-label')) !!}
				<div class="col-sm-10 col-md-8">
					{!! Form::textarea('description', null, array('class' => 'form-control', 'placeholder' => 'Select braintree plan', 'readonly')) !!}
				</div>
			</div>

			<div class="form-group">
				<div class="col-sm-offset-2 col-sm-10 col-md-offset-2 col-md-10">
					{!! Form::checkbox('published', true) !!} Published
				</div>
			</div>
				
			<div class="form-group form-actions">
				<div class="col-sm-offset-2 col-sm-10 col-md-offset-2 col-md-10">
					{{ link_to_route('plan.index', 'Cancel', null, array('class' => 'btn btn-default')) }}
				    {!! Form::submit('Save', array('class' => 'btn btn-success')) !!}
			    </div>
			</div>
		
		{!! Form::close() !!}
				
	</div>

	<script type="text/javascript">
		$('#braintree_select').change(function() {
		    var opt = $(this.options[this.selectedIndex]);

		    $('#amount').val(opt.attr('data-price'));
		    $('#interval').val(opt.attr('data-cycle'));
		    $('#description').text(opt.attr('data-description'));
		});
	</script>
@endsection