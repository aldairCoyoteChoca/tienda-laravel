@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif
            @foreach ($products as $product)
            <div class="card">
                <div class="card-header"> {{ $product->name }} </div>
                <div class="card-body">
                   @if ($product->file)
                   <img src="{{ asset('/'.$product->file) }}" class="card-img-top">
                   @endif
                   {{ $product->excerpt }}
                   <a href=" {{ route('product', $product->slug) }} ">Leer más</a>
                </div>
            </div>
            @endforeach
            {{ $products->render() }}
        </div>
    </div>
</div>
@endsection