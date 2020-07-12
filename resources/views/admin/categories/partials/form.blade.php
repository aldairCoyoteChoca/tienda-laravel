<div class="form-group">
{{ Form::label('name', 'Nombre de la categoría') }}
{{ Form::text('name', null, ['id' => 'name','class' => 'form-control']) }}
</div>

<div class="form-group">
{{ Form::label('slug', 'URL Amigable') }}
{{ Form::text('slug', null, ['id' => 'slug', 'class' => 'form-control']) }}
</div>

<div class="form-group">
{{ Form::label('body', 'Descripción') }}
{{ Form::text('body', null, ['class' => 'form-control']) }}
</div>

<div class="form-group">
{{ Form::submit('Guardar', ['class' => 'btn btn-sm btn-primary']) }}
</div>