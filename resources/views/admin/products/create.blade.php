@extends('admin.admin')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Productos</h1>
        @can('products.create')
        <a href=" {{ route('products.create') }}" class="btn btn-sm btn-primary shadow-sm">Crear producto</a>
        @endcan
    </div>
    <div class="card shadow mb-12">
        <div class="card-body">
            <div class="card-body">
                {!! Form::open(['route' => 'products.store', 'files' => true]) !!}
                @include('admin.products.partials.form')
               {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@endsection
