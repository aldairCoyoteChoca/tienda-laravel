@extends('layouts.app')

@section('content')
<br>
<br>
<br>
<div class="container">
  <ul class="nav nav-pills mb-12" id="pills-tab" role="tablist">
    <li class="nav-item">
      <a class="nav-link active" id="pills-encamino-tab" data-toggle="pill" href="#pills-encamino" role="tab" aria-controls="pills-encamino" aria-selected="false">En camino</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" id="pills-entregados-tab" data-toggle="pill" href="#pills-entregados" role="tab" aria-controls="pills-entregados" aria-selected="true">Entregados</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" id="pills-cancelados-tab" data-toggle="pill" href="#pills-cancelados" role="tab" aria-controls="pills-cancelados" aria-selected="false">Cancelados</a>
    </li>
  </ul>
  <div class="tab-content" id="pills-tabContent">
    {{-- pedidos en camino --}}
    <div class="tab-pane fade show active" id="pills-encamino" role="tabpanel" aria-labelledby="pills-encamino-tab">
      @forelse ($cartsPending as $cart)
      <div class="card text-center">
        <div class="card-header">
          Pedido "{{ config('app.name') }} {{$cart->id}}" 
        </div>
        <div class="card-body">
          <h5 class="card-title">Estado: {{ $cart->status}} - Cliente: {{$cart->user_id}}</h5>
          <p class="card-text">Fecha de orden: {{\Carbon\Carbon::parse($cart->order_date)->format('d/m/Y')}}</p>
          <a href="{{ route('pedido', $cart->id)}}" class="btn btn-sm btn-primary">Ver pedido</a>
        </div>
        <div class="card-footer text-muted">
          <button class="btn btn-sm btn-danger" data-toggle="modal" data-target="#modalcancel{{$cart->id}}"><i class="fas fa-trash"></i> Cancelar pedido</button>
        </div>
      </div>
      <div class="modal fade" id="modalcancel{{$cart->id}}" tabindex="-1" role="dialog" aria-labelledby="modalcancelTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header mx-auto">
                    <h5 class="modal-title mx-auto" id="modalcancelTitle">Pedido "{{ config('app.name') }} {{$cart->id}}" </h5>
                </div>
                <div class="modal-body mx-auto">
                    ¿Estás seguro de querer cancelar este pedido?</h6>
                </div>
                <div class="mx-auto">
                    <small>Esta acción no puede deshacerse.</small>
                </div>
                <div class="mx-auto">
                  <small>Se enviara un correo de cancelación.</small>
              </div>
                <div class="modal-footer mx-auto">
                    <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Cancelar</button>
                    <form method="POST" action="{{ route('cancelar') }}">
                      @csrf
                      <input type="hidden" name="id" value="{{$cart->id}}">
                      <button class="btn btn-sm btn-danger text-white"><i class="fas fa-trash"></i> Cancelar
                      </button>
                    </form>
                </div>
            </div>
          </div>
      </div>
      <br>
      <hr>
      @empty
      <br>
      <br>
      <br>
      <br>
      <br>
      <br>
      <br>
      <br>
      <div class="container">
        <h5 class="text-center text-monospace">¡No tienes pedidos en camino aún!</h5>
      </div>
      @endforelse
      {{-- {{ $cartsPending->render() }} --}}
    </div>
    {{-- pedidos entregados --}}
    <div class="tab-pane fade" id="pills-entregados" role="tabpanel" aria-labelledby="pills-entregados-tab">
      <div id="test-swipe-2" class="col s10">
        @forelse ($cartsEntregados as $cart)
        <div class="card text-center">
          <div class="card-header">
            Pedido "{{ config('app.name') }} {{$cart->id}}" 
          </div>
          <div class="card-body">
            <h5 class="card-title">Estado: {{ $cart->status}} - Cliente: {{$cart->user_id}}</h5>
            <p class="card-text">Fecha de orden: {{\Carbon\Carbon::parse($cart->order_date)->format('d/m/Y')}}</p>
            <p class="card-text">Fecha de entrega: {{\Carbon\Carbon::parse($cart->arrived_date)->format('d/m/Y')}}</p>
            <a href="{{ route('pedido', $cart->id)}}" class="btn btn-sm btn-primary">Ver pedido</a>
          </div>
          <div class="card-footer text-muted">
          </div>
        </div>
        <br>
        <hr>
          @empty
          <br>
          <br>
          <br>
          <br>
          <br>
          <br>
          <br>
          <br>
          <div class="container">
            <h5 class="text-center text-monospace">¡No tienes pedidos entregados aún!</h5>
          </div>
          @endforelse
        </div>
      </div>
    {{-- pedidos cancelados --}}
    <div class="tab-pane fade" id="pills-cancelados" role="tabpanel" aria-labelledby="pills-cancelados-tab">
      <div id="test-swipe-3" class="col s10">
        @forelse ($cartsCancelados as $cart)
        <div class="card text-center">
          <div class="card-header">
            Pedido "{{ config('app.name') }} {{$cart->id}}" 
          </div>
          <div class="card-body">
            <h5 class="card-title">Estado: {{ $cart->status}} - Cliente: {{$cart->user_id}}</h5>
            <p class="card-text">Fecha de orden: {{\Carbon\Carbon::parse($cart->order_date)->format('d/m/Y')}}</p>
            <p class="card-text">Fecha de cancelación: {{\Carbon\Carbon::parse($cart->cancel_order)->format('d/m/Y')}}</p>
            <a href="{{ route('pedido', $cart->id)}}" class="btn btn-sm btn-primary">Ver pedido</a>
          </div>
          <div class="card-footer text-muted">
          </div>
        </div>
      <br>
      <hr>
      @empty
      <br>
      <br>
      <br>
      <br>
      <br>
      <br>
      <br>
      <br>
      <div class="container">
        <h5 class="text-center text-monospace">¡No tienes pedidos cancelados aún!</h5>
      </div>
      @endforelse
      </div>
    </div>
  </div>
</div>
@endsection