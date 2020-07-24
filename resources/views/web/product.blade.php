@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"> {{ $product->name }} </div>
                <div class="card-body">
                    @if ($product->file)
                    <img src="{{ asset('/'.$product->file) }}" class="card-img-top">
                    @endif
                    <hr>
                    {{ $product->excerpt }}
                    <hr>
                    categorias: <a href=" {{ route('category', $product->category->slug) }} "> {{ $product->category->name }} </a>
                    <hr>   
                    {!! $product->description !!}
                    <hr>
                    Etiquetas:
                    @foreach ($product->tags as $tag)
                    <a href=" {{ route('tag', $tag->slug) }} ">{{ $tag->name }} </a>
                    @endforeach
                    <br>
                    @if ($product->stock === 0)
                    <button class="btn btn-sm btn-primary">
                        Producto no disponible
                    </button>
                    @else
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
                            Agregar al carrito.
                        </button>
                    </form>
                    @endisset 
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection