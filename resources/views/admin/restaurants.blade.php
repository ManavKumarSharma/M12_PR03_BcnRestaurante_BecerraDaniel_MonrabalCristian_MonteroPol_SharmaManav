@extends('admin.layout.crud')

@section('title', "Gestión de $title")

{{-- Agregamos los scripts específicos de esta vista --}}
@push('scripts')
    <script src="{{ asset('js/admin/restaurants/table.js') }}"></script>
    <script src="{{ asset('js/admin/restaurants/restaurantManagement.js') }}"></script>
@endpush