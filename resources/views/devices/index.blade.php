@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <tiny-pump-device-card v-bind:userid="{{ $user_id }}"/>
    </div>
    <div class="row justify-content-center">
        <tiny-t-device-card v-bind:userid="{{ $user_id }}"/>
    </div>
</div>
@endsection