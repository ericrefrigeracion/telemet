@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="main">
            	<div id="app">
            		<input type="tex" v-model="info">
            	</div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('footer_scripts')
<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
<script>
const app = new Vue({
	el:'#app',
	data:{
		info:'texto inicial'
	}

})
</script>
@endsection