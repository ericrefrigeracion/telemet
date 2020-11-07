@extends('layouts.app')

@section('content')
<div class="container-fluid">
	<div class="row justify-content-center">
		<div class="card-columns col-md-10">
			@foreach($devices as $device)
			    	@if($device->type_device->model == 'Tiny')
			    		<div>
			     			<tiny-device-card v-bind:device="{{ $device->id }}"></tiny-device-card>
			     		</div>
			     	@endif
			     	@if($device->type_device->model == 'Health')
			     		<div>
			        		<health-device-card v-bind:device="{{ $device->id }}"></health-device-card>
			        	</div>
			        @endif
			        @if($device->type_device->model == 'Dairy')
			     		<div>
			        		<dairy-device-card v-bind:device="{{ $device->id }}"></dairy-device-card>
			        	</div>
			        @endif
		    @endforeach
		</div>
    </div>
</div>
@endsection