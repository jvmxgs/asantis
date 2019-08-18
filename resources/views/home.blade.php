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

@endpush
