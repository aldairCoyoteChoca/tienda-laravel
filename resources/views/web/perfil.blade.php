@extends('layouts.app')

@section('content')
<br>
<br>
<br>
<div class="container">
  <div class="row">
    <div class="col">
      <div class="card text-center">
        <div class="card-header">
          {{ Auth::user()->name }}
        </div>
        <br>
        <div class="col">
            @if (Auth::user()->photo)
            <img class="card-img" src=" {{ asset(Auth::user()->photo) }} " style="width:120px; border-radius:150px;" class="d-block w-100 "> 
            @endif
        </div>
        <hr>
        <div class="row">
            <div class="col-12">
              <h3>Datos:</h3>
            </div>
            <div class="col-4">
              <strong>Correo:</strong> 
              {{ Auth::user()->email }}
            </div>
            <div class="col-4">
              <strong>Teléfono:</strong>
              {{ Auth::user()->phone }}
            </div>
            <div class="col-4">
              <strong>Dirección:</strong>
              {{ Auth::user()->address }} {{ Auth::user()->postal_code }}
            </div>
          </div>
          <hr>
          <div class="row">
            <div class="col-12">
              <h3>Datos fiscales:</h3>
            </div>
            <div class="col-4">
              <strong>Nombre:</strong>
              {{ Auth::user()->name_fiscal }}
            </div>
            <div class="col-4">
              <strong>Dirección fiscal:</strong>
               {{ Auth::user()->address_fiscal }}
            </div>
            <div class="col-4">
              <strong>RFC:</strong>
               {{ Auth::user()->rfc }}
            </div>
        </div>
        <br>
        <div class="card-footer text-muted">
          <a class="btn btn-sm btn-primary" href=" {{ route('user.edit', Auth::user()->id) }} ">Editar perfil</a>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
