@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h2 class="mb-4">Perfil de Usuario</h2>

            @if(session('status'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('status') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <!-- Cambiar Nombre de Usuario -->
            <div class="card mb-4">
                <div class="card-header">Cambiar Nombre de Usuario</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('profile.username') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="new_username" class="form-label">Nuevo Nombre de Usuario</label>
                            <input type="text" class="form-control @error('new_username') is-invalid @enderror" 
                                   id="new_username" name="new_username" value="{{ old('new_username') }}" required>
                            @error('new_username')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Actualizar Nombre</button>
                    </form>
                </div>
            </div>

            <!-- Cambiar Email -->
            <div class="card mb-4">
                <div class="card-header">Cambiar Email</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('profile.email') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="new_email" class="form-label">Nuevo Email</label>
                            <input type="email" class="form-control @error('new_email') is-invalid @enderror" 
                                   id="new_email" name="new_email" value="{{ old('new_email') }}" required>
                            @error('new_email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Actualizar Email</button>
                    </form>
                </div>
            </div>

            <!-- Cambiar Contraseña -->
            <div class="card mb-4">
                <div class="card-header">Cambiar Contraseña</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('profile.password') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="current_password" class="form-label">Contraseña Actual</label>
                            <input type="password" class="form-control @error('current_password') is-invalid @enderror" 
                                   id="current_password" name="current_password" required>
                            @error('current_password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="new_password" class="form-label">Nueva Contraseña</label>
                            <input type="password" class="form-control @error('new_password') is-invalid @enderror" 
                                   id="new_password" name="new_password" required>
                            @error('new_password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="new_password_confirmation" class="form-label">Confirmar Nueva Contraseña</label>
                            <input type="password" class="form-control" 
                                   id="new_password_confirmation" name="new_password_confirmation" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Actualizar Contraseña</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
