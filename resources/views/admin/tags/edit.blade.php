@extends('admin.admin')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Etiqueta</h1>
        @can('tags.create')
        <a href=" {{ route('tags.create') }}" class="btn btn-sm btn-primary shadow-sm">Crear Etiqueta</a>
        @endcan
    </div>
    <div class="card shadow mb-12">
        <div class="card-body">
            <div class="card-body">
                {!! Form::model($tag, ['route' => ['tags.update', $tag->id],
                'method' => 'PUT']) !!}
                 @include('admin.tags.partials.form')
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@endsection
