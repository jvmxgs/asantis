@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-3">
            <div class="card">
                <div class="card-header">
                    Opciones
                </div>
                <div class="card-body">
                    <menu-component></menu-component>
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <div class="card">
                <div class="card-header"><i class="fas fa-tachometer-alt"></i> Panel de control</div>

                <div class="card-body">
                    <router-view></router-view>
                    @yield('routerview')
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('script')
<link rel="stylesheet" href="{{ asset('js/vendor/leaftlet/leaflet.css') }}" />
<link rel="stylesheet" href="{{ asset('js/vendor/leaflet-routing-machine/leaflet-routing-machine.css') }}" />
<script src="{{ asset('js/vendor/leaftlet/leaflet.js') }}"></script>
<script src="{{ asset('js/vendor/leaflet-routing-machine/leaflet-routing-machine.min.js') }}"></script>
<script src="https://unpkg.com/esri-leaflet@2.3.0/dist/esri-leaflet.js"
    integrity="sha512-1tScwpjXwwnm6tTva0l0/ZgM3rYNbdyMj5q6RSQMbNX6EUMhYDE3pMRGZaT41zHEvLoWEK7qFEJmZDOoDMU7/Q=="
    crossorigin=""></script>
    <link rel="stylesheet" href="https://unpkg.com/esri-leaflet-geocoder@2.2.14/dist/esri-leaflet-geocoder.css"
        integrity="sha512-v5YmWLm8KqAAmg5808pETiccEohtt8rPVMGQ1jA6jqkWVydV5Cuz3nJ9fQ7ittSxvuqsvI9RSGfVoKPaAJZ/AQ=="
        crossorigin="">
    <script src="https://unpkg.com/esri-leaflet-geocoder@2.2.14/dist/esri-leaflet-geocoder.js"
        integrity="sha512-uK5jVwR81KVTGe8KpJa1QIN4n60TsSV8+DPbL5wWlYQvb0/nYNgSOg9dZG6ViQhwx/gaMszuWllTemL+K+IXjg=="
        crossorigin=""></script>
@endpush
