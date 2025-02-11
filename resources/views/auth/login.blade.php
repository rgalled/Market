@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-lg rounded-4 border-0">
                <div class="card-header text-center" style="background-color: #5BC0EB; color: white;">{{ __('Login') }}</div>

                <div class="card-body" style="background-color: #f5f5f5;">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="email" class="form-label">{{ __('Email') }}</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">{{ __('Password') }}</label>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-0 d-grid gap-2">
                            <button type="submit" class="btn btn-light-blue rounded-pill">
                                {{ __('Login') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

<style>
    .card {
        border-radius: 16px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .btn-light-blue {
        background-color: #5BC0EB;
        color: white;
    }

    .btn-light-blue:hover {
        background-color: #42A6D9;
    }

    .form-control:focus {
        border-color: #5BC0EB;
        box-shadow: 0 0 0 0.25rem rgba(91, 192, 235, 0.25);
    }

    .invalid-feedback {
        color: #FF6B6B;
    }

    .card-header {
        font-size: 1.5rem;
        font-weight: bold;
    }
</style>
