{{-- Incluir la plantilla --}}
@extends('admin.layout.crud')

@if (!Auth::check())
    <script>
        window.location.href = "{{ route('login') }}";
    </script>
@else

@section('title', "Gestión de $title")

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

@endif
