@extends('layouts.app')

@section('content')
<br>
<br>
<br>
<div class="container">
    <div class="row row-cols-1 row-cols-md-3">
        @foreach ($products as $product)
        @if ($product->stock >= 1)
        <div class="col mb-4">
          <div class="card h-100 text-center">
            <div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">
                <a href=" {{ route('product', $product->slug) }} ">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            @if ($product->file)
                            <img src="{{ asset('/'.$product->file) }}" class="d-block w-100">
                            @endif
                        </div>
                    </div>
                </a>
            </div>
            <div class="card-body">
                <h5 class="card-title text-center text-truncate">{{ $product->name }}</h5>
                <p class="card-text text-center text-truncate"> {{ $product->excerpt }}</p>
                <h5 class="text-center"> ${{ $product->price }}.00 </h5>
            </div>
            <div class="card-footer">
                {{-- /<a class="btn btn-sm btn-success float-left" href=" {{ route('products.edit', $product->id) }}">Editar</a> --}}
                @isset(Auth::user()->name)
                <form method="POST" action="{{ route('carrito.add', $product->id) }}">
                    @csrf
                    <input type="hidden" name="product_id" value="{{$product->id}}">
                    <input type="hidden" name="quantify" value="1">
                    <input type="hidden" name="price" value="{{ $product->price }}">
                    <button class="add btn btn-sm btn-primary">
                        Agregar al carrito 
                        <i class="fas fa-cart-arrow-down"></i>
                    </button>
                </form>
                @else
                <form action="{{ route('login') }}">
                    <button class="btn btn-sm btn-primary">
                        <i class="fas fa-cart-arrow-down"></i>
                        Agregar
                    </button>
                </form>
                @endisset
            </div>
          </div>
        </div>
        @endif
        @endforeach
    </div>
    {{ $products->render() }}
</div>
@endsection