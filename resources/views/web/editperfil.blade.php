@extends('layouts.app')
@section('content')
<br>
<br>
<br>
<div class="container">
  <div class="row">
    <div class="col">
      <div class="card text-center">
        {!! Form::model($user, ['route' => ['user.update', auth()->user()->id],
        'method' => 'PUT', 'files' => true]) !!}
          <div class="card-header">
            <div class="float-left">
              @if (Auth::user()->photo)
              <img class="card-img" src=" {{ asset(Auth::user()->photo) }} " style="width:80px; border-radius:150px;" class="d-block w-100 "> 
              @endif
            </div>
            {{ Form::label('name', 'Nombre del usuario') }}
            {{ Form::text('name', null, ['class' => 'form-control col-4 mx-auto']) }}
          </div>
          <div class="row">
            <div class="col-12">
              <h3>Datos:</h3>
            </div>
            <div class="col-3">
              {{ Form::label('email', 'Correo') }}
              {{ Form::text('email', null, ['class' => 'form-control']) }}
            </div>
            <div class="col-3">
                {{ Form::label('address', 'Dirección de entrega') }}
                {{ Form::text('address', null, ['class' => 'form-control']) }}
            </div>
            <div class="col-3">
                {{ Form::label('postal_code', 'Código postal') }}
                {{ Form::text('postal_code', null, ['class' => 'form-control']) }}
            </div>
            <div class="col-3">
                {{ Form::label('phone', 'Teléfono') }}
                {{ Form::text('phone', null, ['class' => 'form-control']) }}
            </div>
          </div>
          <hr>
          <div class="row">
              <div class="col-12">
                {{ Form::label('photo_up', 'Imagen:') }}
                {{ Form::file('photo_up',['id' => 'photo_up', 'accept' => 'image/*']) }}
              </div>
          </div>
          <div class="card-footer text-muted mx-auto">
            {{ Form::submit('Guardar', ['class' => 'btn btn-sm btn-primary']) }}
          </div>
       {!! Form::close() !!}
      </div>
    </div>
  </div>
</div>        
@endsection
@section('scripts')
<script>
  $('#photo_up').fileinput({
      language:'es',
      allowedFileExtensions: ['jpg', 'jpeg', 'png'],
      maxFileSize: 1000,
      showUpload: false,
      showClose:false,
      initialPreviewAsData: true,
      dropZoneEnabled:false,
      theme: "fas",
  });
</script>
@endsection