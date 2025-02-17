@extends('layouts.plantilla_restaurante')

@section('title', 'Mi Perfil')

@section('content')

@if(session('status'))
    <div class="container mt-4">
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    </div>
@endif

<!-- Encabezado con imagen de fondo y avatar -->
<div class="container-fluid p-0">
    <div class="text-center py-5" style="background: url('{{ asset('img/zona-usuario.jpg') }}') center/cover no-repeat;">
        <div class="container">
            <div class="d-flex flex-column align-items-center">
                <div class="rounded-circle border border-3 border-white overflow-hidden mb-2" style="width: 120px; height: 120px;">
                    <img src="{{ asset($user->profile_image ? 'img/' . $user->profile_image : 'img/user.jpg') }}"
                         alt="Foto de perfil"
                         class="img-fluid rounded-circle w-100 h-100 object-fit-cover">
                </div>
                <h3 class="mb-0">{{ $user->name }} {{ $user->last_name }}</h3>
                <small class="text-muted">Perfil público</small>
                <div class="mt-2">
                    <button class="btn btn-warning text-white" style="background-color: #f26522; border: none;">
                        Compartir
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
