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
            <div class="card">
                <div class="card-header"> {{ $product->name }} </div>
                <div class="card-body">
                    @if ($product->file)
                    <img src=" {{ $product->file }} " class="card-img-top">
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
                </div>
            </div>
        </div>
    </div>
</div>
@endsection