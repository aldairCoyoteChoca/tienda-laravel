@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Producto</div>
                <div class="card-body">
                   {!! Form::open(['route' => 'products.store', 'files' => true]) !!}
                    @include('admin.products.partials.form')
                   {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
