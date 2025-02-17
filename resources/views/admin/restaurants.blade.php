@extends('admin.layout.crud')

@section('title', "Gestión de $title")

@push('scripts')
    <script src="{{ asset('js/admin/restaurantsManagement.js') }}"></script>
@endpush