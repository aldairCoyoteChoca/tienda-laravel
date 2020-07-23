@extends('admin.admin')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Usuario</h1>
    </div>
    <div class="card shadow mb-12">
        <div class="card-body">
            @if ($user->photo)
            <img src="{{ asset('/'.$user->photo) }}" class="card-img-top img-fluid">
            @endif
            <div class="card-body">
                {!! Form::model($user, ['route' => ['users.update', $user->id],
                   'method' => 'PUT', 'files' => true]) !!}
                    @include('admin.users.partials.form')
                   {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@endsection

