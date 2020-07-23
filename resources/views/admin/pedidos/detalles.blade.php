@extends('admin.admin')

@section('content')
<div class="row">
  <div class="col s12">
    <div class="card blue-grey1">
      <div class="card-content center">
        <span class="card-title green-text">¡Exelente! Nuevo pedido</span>
        <hr>
        <br>
        <span class="card-title orange-text">Datos del cliente</span>
        <hr>
        <table class="striped highlight centered">
          <thead>
            <tr>
              <th>Nombre</th>
              <th>Dirección</th>
              <th>Teléfono</th>
            </tr>
          </thead>
          <tbody>
            <tr>          
              <td>{{ $user->name}}</td>
              <td>{{ $user->address}} {{ $user->postal_code}}</td>
              <td>{{ $user->phone}}</td>
            </tr>
          </tbody>
        </table>
        <br>
        <span class="card-title red-text">Datos del pedido</span>
        <hr>
        <table class="striped highlight centered">
          <thead>
            <tr>
              <th>Nombre Producto</th>
              <th>Cantidad</th>
              <th>Subtotal</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              @foreach ($cart->details as $detail)
              <tr>
                <td >{{ $detail->product->name}}</td>
                <td >{{ $detail->quantify }}</td>
                <td >${{ $detail->subtotal }}</td>
              </tr>
              @endforeach
            </tr>
          </tbody>
        </table>
        <br>
        <span class="card-title blue-text">Total</span>
        <hr>
        <div class="container">
          <table class="striped highlight centered">
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
      <div class="card-action center">
        <a class="waves-light btn modal-trigger green" href="#modal{{ $cart->id }}">
        <i class="material-icons left">done</i>Pedido Entregado</a>
      </div>
    </div>
  </div>
</div>
<!-- Modal Structure -->
<div id="modal{{ $cart->id }}" class="modal">
  <div class="modal-content center">
    <h4>Confirmar pedido</h4>
    <h5 class="center-align">¿El pedido ha sido entregado satisfactoriamente?</h5>
  </div>
  <div class="modal-footer center">
    <button href="#!" class="modal-close waves-green btn-flat left red white-text">No :c</button>
    <form method="POST" action="{{ route('entregado') }}">
      @csrf
      <input type="hidden" name="id" value="{{$cart->id}}">
      <button class="btn waves-light green" type="submit" name="action">Entregado
        <i class="material-icons left">done</i>
      </button>
    </form>
  </div>
</div>
@endsection