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
          @if($product->product->stock >=1)
          <tr>
            <td>
              <img class="" width="50px" src="{{ asset('/'.$product->product->file) }}">
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
                <input type="hidden" name="product_id" value="{{$product->product->id}}">
                <input type="hidden" name="price" value="{{ $product->product->price }}">
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
            <td>$ <span id="subtotal{{ $product->product_id }}">{{ $product->product->price * $product->quantify }}</span> </td>
            <td>
              {!! Form::open(['route' => ['carrito.delete', $product->id],
              'method' => 'DELETE']) !!}
                <button class="delete">
                  <i class="">delete_forever</i> 
                </button>
              {!! Form::close() !!}
            </td>
          </tr>
          @endif
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
                $<span id="total_car" >{{ auth()->user()->cart->total }}</span>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
      <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal1">
      Ordenar pedido
    </button>
  </div>
</div>
<!-- Modal -->
<div class="modal fade" id="modal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        {{-- <h5 class="modal-title" id="exampleModalLabel">Pagar</h5> --}}
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form class="needs-validation" novalidate id="card-form">
        <div class="modal-body">
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
                        <label for="cardChange">
                          Número de tarjeta: </label>	
                        <input type="text" class="form-control" id="cardChange" minlength="16" 
                          maxlength="16" required placeholder="16 Dígitos*"/>
                        <div class="invalid-tooltip" id="cardregex">
                          Falta tu número de tarjeta.
                        </div>
                      </div>
                      <div class="form-group col-lg-6">
                          <label for="cvc">CVC/ CVV:</label>
                          <input type="text" class="form-control" id="cvc" placeholder="CVC/ CVV*"
                                  required maxlength="4" minlength="3" data-conekta="card[cvc]" pattern="\d{3,4}">
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
                      <div class="form-group col-lg-6">
                        <div class="container">
                          <span name="total" id="gran_total">{{ auth()->user()->cart->total }}</span>
                        </div>
                      </div>
                  </div>
              </div>
          </div>
        </div>
        <div class="modal-footer justify-content-center">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
          <button type="submit" class="btn btn-primary">
            Pagar
          </button>
        </div>
        <input type="hidden" name="conektaTokenId" id="conektaTokenId">
        <input type="hidden" name="description" id="description" value="Carrito: {{ auth()->user()->cart->id }}">
        <input type="hidden" name="total" id="total" value="{{ auth()->user()->cart->total }}">
        <input type="hidden" id="card" name="card" minlength="16" maxlength="16" data-conekta="card[number]" required/>
      </form>
      {!! Form::open(['route' => ['carrito.order'], 'id' => 'enviar',
      'method' => 'POST']) !!}
        {{ Form::hidden('id', auth()->user()->cart->id) }}
      {!! Form::close() !!}
    </div>
  </div>
</div>
<div class="modal fade" id="modalLoader" tabindex="-1" role="dialog" aria-labelledby="modalLoaderTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="d-flex mx-auto">
      <div class="spinner-grow" style="width: 8rem; height: 8rem;" role="status">
        <span class="sr-only">Loading...</span>
      </div>
    </div>
  </div>
</div>
@endsection
@section('scripts')
<script src="{{ asset('js/carshop.js') }}"></script>
<script src="{{ url('https://cdn.conekta.io/js/latest/conekta.js')}}"></script>
@endsection
