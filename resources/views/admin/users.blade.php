@extends('admin.layout.crud')

@section('title', "Gestión de $title")

{{-- Verificación de autenticación y autorización --}}
@unless(Auth::check() && Auth::user()->rol_id === 1)
    @php
        header("Location: " . route('login'));
        exit();
    @endphp
@endunless

{{-- Incluimos el modal --}}
@section('modal')
    @include('admin.includes.userModal')
    @include('admin.includes.filterModal')
@endsection

{{-- Agregamos los scripts específicos de esta vista --}}
@push('scripts')
    <script src="{{ asset('js/admin/users/table.js') }}"></script>
    <script src="{{ asset('js/admin/users/userManagement.js') }}"></script>
    <script src="{{ asset('js/admin/users/delete.js') }}"></script>
    <script src="{{ asset('js/admin/users/create.js') }}"></script>
    <script src="{{ asset('js/admin/users/edit.js') }}"></script>
    <script src="{{ asset('js/admin/users/admin.js') }}"></script>
@endpush