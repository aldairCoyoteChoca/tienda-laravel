@extends('layouts.app')

@section('content')
<div class="container ">
  <div class="row">
    <div class="card">
      <div class="card-content center">
        <a class="btn-small left pink darken-3" href="{{ url()->previous() }}">
          <i class="material-icons">arrow_back</i>
        </a>
        <span class="card-title center">Mis pedidos</span>
      </div>
      <div class="row">
        <div class="col s12">
          <div class="container  center">
            <ul id="tabs-swipe-demo" class="tabs">
              <li class="tab col s4"><a class="active orange-text" href="#test-swipe-1">¡En camino!</a></li>
              <li class="tab col s4"><a class="green-text" href="#test-swipe-2">Entregados</a></li>
              <li class="tab col s4"><a class="red-text" href="#test-swipe-3">Cancelados</a></li>
            </ul>
            <div id="test-swipe-1" class="col s12">
              @forelse ($carts->where('status', 'Pending') as $cart)
              <ul class="collection">
                @if ($cart->status == 'Pending')
                <li class="collection-item avatar">
                  <a href=" {{ route('pedido', $cart->id)}}" class="">
                    <img src="{{ asset('image/icons/envio.png')}} " alt="" class="circle">
                    <p> Pedido "EATH{{$cart->id}}" </p>
                    <p>
                      <strong>Estado:</strong> ¡En camino!
                    </p>
                    <p>
                      <strong>Fecha de orden: </strong>{{$cart->order_date}}
                    </p>
                    <!-- Modal Trigger para cancelacion-->
                    <a class="secondary-content waves-light btn modal-trigger red" href="#modal{{ $cart->id }}">
                    <i class="material-icons">delete_forever</i></a>
                    <!-- Modal Structure -->
                    <div id="modal{{ $cart->id }}" class="modal">
                      <div class="modal-content center">
                        <h4>Cancelar pedido</h4>
                        <h5 class="center-align">¿Estás seguro de querer cancelar tu pedido?</h5>
                      </div>
                      <div class="modal-footer center">
                        <button href="#!" class="modal-close btn-flat left pink darken-3 white-text">No me canceles :c</button>
                        <form method="POST" action="{{ route('cancelar') }}">
                          @csrf
                          <input type="hidden" name="id" value="{{$cart->id}}">
                          <button class="btn waves-light red" type="submit" name="action">Cancelar
                            <i class="material-icons right">delete_forever</i>
                          </button>
                        </form>
                      </div>
                    </div>
                  </a>
                </li>
                @endif
              </ul>
                @empty
                <h5 class="collection-item center orange-text">¡No tienes pedidos aún!</h5>
                @endforelse
              
            </div>
            <div id="test-swipe-2" class="col s12">
              @forelse ($carts->where('status', 'Entregado') as $cart)
              <ul class="collection center">
                @if ($cart->status == 'Entregado')
                <li class="collection-item avatar center">
                  <a href=" {{ route('pedido', $cart->id)}}" class="collection-item">
                    <img src="{{ asset('image/icons/envio.png')}} " alt="" class="circle">
                    <p> Pedido "EATH{{$cart->id}}" </p>
                    <p>
                      <strong>Estado:</strong> ¡Entregado!
                    </p>
                    <p>
                      <strong>Fecha de orden: </strong>{{$cart->order_date}}
                    </p>
                  </a>
                </li>
                @endif
              </ul>
                @empty
                <h5 class="collection-item center green-text">¡No tienes pedidos entregados aún!</h5>
                @endforelse
               
            </div>
            <div id="test-swipe-3" class="col s12">
              @forelse ($carts->where('status', 'Cancelado') as $cart)
              <ul class="collection center">
                @if ($cart->status == 'Cancelado')
                <li class="collection-item avatar center">
                  <a href=" {{ route('pedido', $cart->id)}}" class="collection-item">
                  <img src="{{ asset('image/icons/envio.png')}} " alt="" class="circle">
                  <p> Pedido "EATH{{$cart->id}}" </p>
                    <p>
                      <strong>Estado:</strong> ¡Cancelado!
                    </p>
                    <p>
                      <strong>Fecha de orden: </strong>{{$cart->order_date}}
                    </p>
                  </a>
                </li>
                @endif
              </ul>
                @empty
                <h5 class="collection-item center red-text">¡No tienes pedidos cancelados aún!</h5>
                @endforelse
                
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection