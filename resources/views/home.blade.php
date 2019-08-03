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
                    <ul class="nav flex-column nav-pills navbar-light bg-white">
                        <li class="nav-item active">
                            <a class="nav-link" href="#">Active</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Active</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <div class="card">
                <div class="card-header"><i class="fas fa-tachometer-alt"></i> Panel de control</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    Has iniciado sesion
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
