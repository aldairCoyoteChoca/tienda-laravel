@extends('admin.admin')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Producto</h1>
        @can('products.create')
        <a href=" {{ route('products.create') }}" class="btn btn-sm btn-primary shadow-sm">Crear producto</a>
        @endcan
    </div>
    <div class="card shadow mb-12">
        <div class="card-body">
            @if ($product->file)
            <img src="{{ asset('/'.$product->file) }}" class="card-img-top img-fluid">
            @endif
            <div class="card-body">
                {!! Form::model($product, ['route' => ['products.update', $product->id],
                   'method' => 'PUT', 'files' => true]) !!}
                    @include('admin.products.partials.form')
                   {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@endsection
