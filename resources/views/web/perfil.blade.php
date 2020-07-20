@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <div class="card">
      <div class="card-content">
        <a class="btn-small left pink darken-3" href="{{ url()->previous() }}">
          <i class="material-icons">arrow_back</i>
        </a>
        <a href="{{ route('user.edit', Auth::user()->id) }}"
          class="waves-effect waves-light btn-small pink darken-3 lighten-1 right">
          <i class="tiny material-icons">edit</i>
        </a>
        <span class="card-title center">{{ Auth::user()->name }}</span>
      </div>
      <div class="row">
        <div class="col s12">
          <hr>
          <div class="card-content center">
            <div class="container">
              @if (Auth::user()->photo)
              <a href="{{ route('user.edit', Auth::user()->id) }}">
                <img class="imgRedonda" src=" {{ asset(Auth::user()->photo) }} " alt="">  
              </a>
              @else
              <img class="imgRedonda" src=" {{ asset('image/icons/default.png') }} " alt="">
              @endif
            </div>
            <hr>
            <div class="container">
              <div class="row">
                <div class="col s12 m3 l3">
                  <strong>Correo:</strong>
                  <span class="card-title center truncate">{{ Auth::user()->email }}</span>
                </div>
                <div class="col s12 m3 l3">
                  <strong>Teléfono:</strong>
                  <span class="card-title center">{{ Auth::user()->phone }}</span>
                </div>
                <div class="col s12 m3 l3">
                  <strong>Dirección de entrega:</strong>
                  <span class="card-title center">{{ Auth::user()->address }}</span>
                </div>
                <div class="col s12 m3 l3">
                  <strong>Codigo Postal:</strong>
                  <span class="card-title center">{{ Auth::user()->postal_code }}</span>
                </div>
              </div>
              
             
              <div class="row">
                <strong>Nombre fiscal:</strong>
                <span class="card-title center">{{ Auth::user()->name_fiscal }}</span>
              </div>
              <div class="row">
                <strong>RFC:</strong>
                <span class="card-title center">{{ Auth::user()->rfc }}</span>
              </div>
              <div class="row">
                <strong>Dirección fiscal:</strong>
                <span class="card-title center">{{ Auth::user()->address_fiscal }}</span>
              </div>
            </div>
          </div>
          <div class="card-action center">
            <a href="{{ route('user.edit', Auth::user()->id) }}"
              class="waves-effect waves-light btn-small pink darken-3 lighten-1">Actualizar
              <i class="tiny material-icons right">edit</i>
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection