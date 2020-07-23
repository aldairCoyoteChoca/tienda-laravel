@extends('admin.admin')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Categoria</h1>
        @can('categories.edit')
        <a href=" {{ route('categories.edit', $category->id) }}" class="btn btn-sm btn-primary shadow-sm">Editar categoria</a>
        @endcan
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card mt-4">
                <div class="card-body">
                    <p><strong>Nombre:</strong> {{ $category->name }} </p>
                    <p><strong>Descripción:</strong> {{ $category->body }} </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
