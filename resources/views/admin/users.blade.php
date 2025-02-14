{{-- Incluir la plantila --}}
@extends('admin.layout.crud') 

@section('title', "Gestión de $title")

{{-- Agregamos los scripts específicos de esta vista --}}
@push('scripts')
    <script src="{{ asset('js/usersManagement.js') }}"></script>
@endpush