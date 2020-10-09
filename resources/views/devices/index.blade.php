@extends('layouts.app')

@section('content')
<div class="container-fluid">
	@foreach($devices as $device)
	    <div class="row justify-content-center">
	    	@if($device->type_device->id == 2)
	     		<tiny-device-card v-bind:device="{{ $device }}"/>
	     	@endif
	     	@if($device->type_device->id == 3)
	        	<dairy-device-card v-bind:device="{{ $device }}"/>
	        @endif
	    </div>
    @endforeach
</div>
@endsection