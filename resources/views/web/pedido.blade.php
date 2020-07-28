
@extends('layouts.app')

@section('content')
<br>
<br>
<br>
<br>
<div class="container">
  <div class="row">
    <div class="card">
      <div class="card-content center">
        <a class="btn-small left green" href="{{ url()->previous() }}">
          <i class="material-icons">arrow_back</i>
        </a>
      <span class="card-title center">Pedido</span>
      </div>
      <div class="row">
        <table class="striped highlight centered">
          <thead>
            <tr>
              <th>#</th>
                <th>Nombre</th>
                <th>Precio</th>
                <th>Cantidad</th>
                <th>Subtotal</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($productos as $producto)
              <tr>
                <td>
                  @isset($producto->product->file)
                  <img class="hide-on-small-only" width="50px" src="{{ asset($producto->product->file) }}">
                  @endisset
                </td>
                <td>
                  <a href="{{route('product', $producto->product->slug)}}">
                    {{ $producto->product->name }}
                  </a>
                </td>
                <td>${{ $producto->price }}</td>
                <td>{{ $producto->quantify }}</td>
                <td>${{ $producto->price * $producto->quantify }}</td>
              </tr>
              @endforeach
            </tbody>
        </table>
        <div class="container">
            <table class="striped highlight right col s12 m6 l6 xl3">
              <thead>
                <tr>
                  <th>Total de productos</th>
                  <th>Total</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td class="center">
                      {{$totalProductos}}
                  </td>
                  <td>
                    $ {{ $total }}
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
      </div>
    </div>
  </div>
</div>
@endsection