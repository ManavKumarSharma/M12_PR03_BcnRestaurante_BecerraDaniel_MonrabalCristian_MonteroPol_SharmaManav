{{-- Incluir la plantila --}}
@extends('admin.layout.crud')

@section('title', "Gestión de $title")

{{-- Incluímos el modal --}}
@section('modal')
    @include('admin.includes.userModal')
@endsection

{{-- Agregamos los scripts específicos de esta vista --}}
@push('scripts')
    <script src="{{ asset('js/admin/users/table.js') }}"></script>
    <script src="{{ asset('js/admin/users/userManagement.js') }}"></script>
    <script src="{{ asset('js/admin/users/delete.js') }}"></script>
@endpush