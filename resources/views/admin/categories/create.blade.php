@extends('admin.admin')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Categoria</h1>
        @can('categories.create')
        <a href=" {{ route('categories.create') }}" class="btn btn-sm btn-primary shadow-sm">Crear categoria</a>
        @endcan
    </div>
    <div class="card shadow mb-12">
        <div class="card-body">
            <div class="card-body">
                {!! Form::open(['route' => 'categories.store', 'files' => true]) !!}
                @include('admin.categories.partials.form')
               {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@endsection