@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-lg">
                <div class="card-header text-center bg-success text-white">{{ __('Email Verificado') }}</div>

                <div class="card-body text-center">
                    <div class="alert alert-success" role="alert">
                        <i class="fas fa-check-circle fa-2x"></i>
                        <br>
                        <strong>{{ __('Tu email ha sido verificado correctamente.') }}</strong>
                    </div>
                    <a href="{{ route('home') }}" class="btn btn-success w-100">
                        <i class="fas fa-home"></i> {{ __('Regresar al Inicio') }}
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
