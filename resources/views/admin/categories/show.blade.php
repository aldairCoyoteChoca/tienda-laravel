@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Categoria</div>
                <div class="card-body">
                   <p><strong>Nombre:</strong> {{ $category->name }} </p>
                   <p><strong>Descripción:</strong> {{ $category->body }} </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection