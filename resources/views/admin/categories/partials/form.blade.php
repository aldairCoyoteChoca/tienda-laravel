<div class="form-group">
{{ Form::label('name', 'Nombre de la categoría') }}
{{ Form::text('name', null, ['id' => 'name','class' => 'form-control', 'maxlength' => '10']) }}
</div>

<div class="form-group">
{{ Form::hidden('slug', null, ['id' => 'slug', 'class' => 'form-control']) }}
</div>

<div class="form-group">
{{ Form::label('body', 'Descripción') }}
{{ Form::text('body', null, ['class' => 'form-control']) }}
</div>

<div class="form-group">
{{ Form::submit('Guardar', ['class' => 'btn btn-sm btn-success']) }}
</div>

@section('scripts')
<script src="{{ asset('vendor/stringToSlug/jquery.stringToSlug.min.js')}}"></script>
<script>
$(document).ready(function(){
  $("#name, #slug").stringToSlug({
    callback: function(text){
        $("#slug").val(text)
    }
  })
})
</script>    
@endsection