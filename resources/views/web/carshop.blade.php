@extends('layouts.app')

@section('content')
<h2 class="">Carrito de Compras</h2>
  <div class="container">
    <div class="row">
    <hr>
    <table class="">
      <thead>
        <tr>
          <th></th>
          <th>Nombre</th>
          <th>Precio</th>
          <th>Cantidad</th>
          <th>Subtotal</th>
          <th>Eliminar</th>
        </tr>
      </thead>
      <tbody>
          @forelse ($products as $product)
          <tr>
            <td>
              <img class="" width="50px" src="{{ asset('/'.$product->file) }}">
            </td>
            <td>
              <a class="" href="{{route('product', $product->product->slug)}}">
                  {{ $product->product->name }}
              </a>
            </td>
            <td>$ {{ $product->product->price}}</td>
            <td>
              <form method="POST" action="{{ route('carrito.update') }}">
                @csrf
                <input type="hidden" name="product_id" value="{{$product->product_id}}">
                <input type="hidden" name="price" value="{{ $product->price }}">
                <select name="quantify" class="update form-control">
                  @for ($i = 1; $i <= $product->product->stock; $i++)
                  @if ($i == $product->quantify)
                  <option selected value="{{$i}}"> {{$i}} </option>
                  @else
                  <option value="{{$i}}"> {{$i}} </option>
                  @endif
                  @endfor
                </select>
              </form>
            </td>
            <td>$ {{ $product->price * $product->quantify }} </td>
            <td>
              {!! Form::open(['route' => ['carrito.delete', $product->id],
              'method' => 'DELETE']) !!}
                <button class="delete">
                  <i class="">delete_forever</i> 
                </button>
              {!! Form::close() !!}
            </td>
          </tr>
          @empty
            <h5 class="">Tu carrito está vacío</h5>
          @endforelse
        </tbody>
      </table>
      <hr>
      <div class="container">
        <table class="">
          <thead>
            <tr>
              <th>Total de productos</th>
              <th>Total</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td class="center">
                @if (auth()->user()->cart->details->sum('quantify'))
                <span id="total_productos">
                  {{ auth()->user()->cart->details->sum('quantify')}}
                </span> 
                @else
                0
                @endif
              </td>
              <td>
                $<span id="total" >{{ auth()->user()->cart->total }}</span>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
      <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
      Ordenar pedido
    </button>
  </div>
</div>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        {{-- <h5 class="modal-title" id="exampleModalLabel">Pagar</h5> --}}
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form class="needs-validation" novalidate id="card-form">
          <div class="row" id="formulario">
              <div class="container-fluid sombra espacio" id="cf">
                  <div class="text-center titulo espacio">TARJETAHABIENTE</div>
                  <div class="row">
                      <div class="form-group col-12">
                          <label for="name">Nombre del Tarjetahabiente:</label>
                          <input type="text" class="form-control" name="name" id="name"  placeholder="Nombre completo*" required
                                  maxlength="200" data-conekta="card[name]" onblur="firstMayus('name')">
                          <div class="invalid-tooltip">
                              Falta tu nombre.
                          </div>
                      </div>
                  </div>
                  <div class="row">
                      <div class="form-group col-lg-6">
                          <label for="email">Correo electrónico:</label>
                          <input type="email" class="form-control"  name="email" id="email" placeholder="E-mail del Tarjetahabiente*"
                                  required data-conekta="card[email]" onblur="allMinus('email')" maxlength="200">
                          <div class="invalid-tooltip">
                              Falta tu correo.
                          </div>
                      </div>
                      <div class="form-group col-lg-6">
                          <label for="telephone">Teléfono:</label>
                          <input type="text" class="form-control" name="telephone" id="telephone" placeholder="10 Dígitos*" required
                                  data-conekta="card[telephone]" maxlength="10" minlength="10" pattern="\d{10}">
                          <div class="invalid-tooltip">
                              Falta tu teléfono (10 dígitos). Solo números.
                          </div>
                      </div>
                  </div>
                  <div class="row">
                      <div class="form-group col-lg-6">
                          <label for="card">Número de tarjeta:</label>
                          <input type="password" class="form-control" name="card" id="card"  placeholder="16 Dígitos*"
                                  required maxlength="16" minlength="15" data-conekta="card[number]" pattern="\d{15,16}">
                          <div class="invalid-tooltip">
                              Falta tu número de tarjeta.
                          </div>
                      </div>
                      <div class="form-group col-lg-6 popover1">
                          <label for="cvc">CVC/ CVV:</label>
                          <input type="password" class="form-control" id="cvc" name="cvc" placeholder="CVC/ CVV*"
                                  required maxlength="4" minlength="3" data-conekta="card[cvc]" data-toggle="popover" 
                                  data-content="<p class='text-center'>Parte posterior de tu tarjeta</p>
                                  <img src='./img/cvv_cvc.png' style='width:100%'>" pattern="\d{3,4}"
                                  data-placement="auto" data-trigger="focus" data-container=".popover1" data-html='true' >
                          <div class="invalid-tooltip">
                              Falta tu CVC/ CVV.
                          </div>
                      </div>
                  </div>
                  <div class="row">
                      <div class="form-group col-lg-6">
                          <label for="mes">Fecha de expiración:</label>
                          <input type="month" class="form-control" id="mes" required placeholder="YYYY-MM*"
                                  pattern="\d{4}([-])((0[1-9]{1})|(1[0-2]{1}))">
                          <input data-conekta="card[exp_month]" class="form-control" id="mesConecta" type="hidden" required>
                          <input data-conekta="card[exp_year]" class="form-control" id="anioConecta" type="hidden" required>
                          <div class="invalid-tooltip">
                              Falta la fecha de expiración(YYYY-MM) o no es una fecha válida.
                          </div>
                      </div>
                  </div>
                  <div class="row">
                   <div class="col-12" id="precio">
                   </div>
                  </div>
              </div>
          </div>
        </form>
      </div>
      <div class="modal-footer justify-content-center">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        {!! Form::open(['route' => ['carrito.order'],
        'method' => 'POST']) !!}
        <button type="button" class="btn btn-primary">
          Pagar
        </button>
        {!! Form::close() !!}
      </div>
    </div>
  </div>
</div>
@endsection
