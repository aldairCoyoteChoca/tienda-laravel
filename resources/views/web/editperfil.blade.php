@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col s12">
      <div class="card">
        <div class="card-content">
          <a class="waves-effect waves-light btn-small btn-small left pink darken-3" href="{{ url()->previous() }}">
            <i class="material-icons">arrow_back</i>
          </a>
          <span class="card-title center">Editar perfil</span>
          <br>
          <div class="">
            {!! Form::model($user, ['route' => ['user.update', Auth::user()->id],
             'method' => 'PUT', 'files' => true]) !!}

                <div class="input-field black-text">
                    {{ Form::label('name', 'Nombre del usuario') }}
                    {{ Form::text('name', null, ['class' => 'form-control']) }}
                </div>
                <div class="input-field black-text">
                    {{ Form::label('address', 'Dirección de entrega') }}
                    {{ Form::text('address', null, ['class' => 'form-control']) }}
                </div>
                <div class="input-field black-text">
                    {{ Form::label('postal_code', 'CP') }}
                    {{ Form::text('postal_code', null, ['class' => 'form-control']) }}
                </div>
                <div class="input-field black-text">
                    {{ Form::label('phone', 'Teléfono') }}
                    {{ Form::text('phone', null, ['class' => 'form-control']) }}
                </div>
                <span class="card-title center">Datos Fiscales (Solo si necesita Factura)</span>
                <div class="input-field black-text">
                    {{ Form::label('name_fiscal', 'Nombre Fiscal') }}
                    {{ Form::text('name_fiscal', null, ['class' => 'form-control']) }}
                </div>
                <div class="input-field black-text">
                    {{ Form::label('address_fiscal', 'Dirección Fiscal') }}
                    {{ Form::text('address_fiscal', null, ['class' => 'form-control']) }}
                </div>
                <div class="input-field black-text">
                    {{ Form::label('rfc', 'RFC') }}
                    {{ Form::text('rfc', null, ['class' => 'form-control']) }}
                </div>
                <span class="card-title">Foto</span>
                <div class="file-field input-field">
                  <div class="btn-small pink darken-3">
                    <span>Foto</span>
                    <input type="file">
                  </div>
                  <div class="file-path-wrapper">
                    <input class="file-path validate" type="text">
                  </div>
                  {{ Form::file('photo', ['class' => 'file'])}}
                </div>
     
                <div class="input-field black-text">
                    {{ Form::submit('Guardar', ['class' => 'btn-small blue']) }}
                </div>
                
            {!! Form::close() !!}
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection