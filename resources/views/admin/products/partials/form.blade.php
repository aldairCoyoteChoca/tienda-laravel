{{ Form::hidden('user_id', auth()->user()->id) }}

<div class="form-group">
    {{ Form::label('category_id', 'Categorias') }}
    {{ Form::select('category_id', $categories, null, ['class' => 'form-control']) }}
</div>

<div class="form-group">
    {{ Form::label('name', 'Nombre del producto') }}
    {{ Form::text('name', null, ['class' => 'form-control']) }}
</div>
<div class="form-group">
    {{ Form::hidden('slug', null, ['class' => 'form-control', 'id' => 'slug']) }}
</div>
<div class="form-group">
    {{ Form::label('price', 'Precio') }}
    {{ Form::number('price', null, ['class' => 'form-control']) }}
</div>
<div class="form-group">
    {{ Form::label('stock', 'Stock(inventario)') }}
    {{ Form::number('stock', null, ['class' => 'form-control']) }}
</div>
<hr>
<div class="form-group">
    {{ Form::label('file', 'Imagen:') }}
    {{ Form::file('file') }}
</div>
<hr>
<div class="form-group">
    {{ Form::label('status', 'Estado') }}:
    <br>
    <label>
        | {{ Form::radio('status', 'PUBLISHED') }} Publicar.
    </label>
    <label>
        | {{ Form::radio('status', 'DRAFT') }} Guardar como borrador.
    </label>
</div>
<hr>
<div class="form-group">
    {{ Form::label('tags','Etiquetas') }}
    <div>
        @foreach ($tags as $tag)
            <label>
                | {{ Form::checkbox('tags[]', $tag->id) }} {{ $tag->name }}
            </label>
        @endforeach
    </div>
</div>
<hr>
<div class="form-group">
    {{ Form::label('excerpt', 'Pie de pagína del producto:') }}
    {{ Form::textarea('excerpt', null, ['class' => 'form-control', 'rows' => '2']) }}
</div>
<div class="form-group">
    {{ Form::label('description', 'Descripción del producto:') }}
    {{ Form::textarea('description', null, ['class' => 'form-control']) }}
</div>
<div class="form-group">
    {{ Form::submit('Guardar', ['class' => 'btn btn-sm btn-success']) }}
</div>

@section('scripts')
<script src="{{ asset('vendor/stringToSlug/jquery.stringToSlug.min.js')}}"></script>
<script src="{{ asset('vendor/ckeditor/ckeditor.js')}}"></script>
<script>
$(document).ready(function(){
  $("#name, #slug").stringToSlug({
    callback: function(text){
        $("#slug").val(text)
    }
  })
})
// Editor de Texto
CKEDITOR.config.height = 'auto'
CKEDITOR.config.width = 'auto'

CKEDITOR.replace('description')
</script>    
@endsection