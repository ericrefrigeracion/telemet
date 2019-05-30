<div class="form-group">
	{{ Form::label('id', 'ID del dispositivo') }}
	{{ Form::number('id', null, ['class' => 'form-control', 'required']) }}
</div>
<div class="form-group">
	{{ Form::label('name', 'Nombre del dispositivo') }}
	{{ Form::text('name', null, ['class' => 'form-control', 'required']) }}
</div>
<div>
	{{ Form::submit('Guardar', ['class' => 'btn btn-sm btn-primary']) }}
</div>