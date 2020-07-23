@extends('admin.admin')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Productos</h1>
        @can('products.edit')
        <a href=" {{ route('products.edit', $product->id) }}" class="btn btn-sm btn-primary shadow-sm">Editar producto</a>
        @endcan
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card mt-4">
                <div class="card-body">
                    @if ($product->file)
                    <img src="{{ asset('/'.$product->file) }}" class="card-img-top img-fluid">
                    @endif
                    <br>
                    <hr>
                    <h3 class="card-title">{{ $product->name }}</h3>
                    <h5>$ {{$product->price}}.00</h5>
                    <h5>Inventario: {{ $product->stock }} piezas</h5>
                    <hr class="sidebar-divider my-0">
                    <br>
                    <h5 class="card-title">Pie de página</h5>
                    <p class="text-justify"> {{ $product->excerpt }} </p>
                    <hr class="sidebar-divider my-0">
                    <br>
                    <h5 class="card-title">Descripción</h5>
                    <p class="text-justify">{!! $product->description !!}</p>
                </div>
            </div>
        </div>
    </div>
    <div class="card card-outline-secondary my-4">
        <div class="card-header">
         Categoria: {{ $product->category->name }}
        </div>
    </div>
    <div class="card card-outline-secondary my-4">
        <div class="card-header">
         Etiquetas:  
         @foreach ($product->tags as $tag)
            | {{ $tag->name }} </a>
         @endforeach
        </div>
    </div>
</div>
@endsection
