@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="d-flex gap-3 align-items-center mb-4">
        @if(Auth::user() != null)
        <a href="{{ route('sales.create') }}" class="btn btn-primary rounded-pill">
            <i class="fas fa-plus"></i> New Product
        </a>
        <a href="{{ route('sales.user', ['user' => Auth::id()]) }}" class="btn btn-secondary rounded-pill">
            <i class="fas fa-box"></i> My Products
        </a>
        @endif
    </div>

    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    @if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
        @foreach($sales as $sale)
        @if(!$sale->isSold)
        <div class="col">
            <div class="card shadow-sm rounded-4 border-0 h-100">
                <div class="position-relative" style="height: 400px;">
                    @if($sale->images->isNotEmpty() && $sale->images->count() == 1)
                    <img src="{{ asset('storage/' . $sale->images->first()->route) }}"
                        class="card-img-top"
                        style="height: 400px; object-fit: cover;"
                        alt="{{ $sale->product }}">
                    @elseif($sale->images->count() > 1)
                    <div id="carousel-{{ $sale->id }}" class="carousel slide" data-bs-ride="carousel" data-bs-interval="false">
                        <div class="carousel-inner">
                            @foreach($sale->images as $image)
                            <div class="carousel-item @if ($loop->first) active @endif">
                                <img src="{{ asset("storage/{$image->route}") }}"
                                    class="d-block w-100"
                                    style="height: 400px; object-fit: cover;"
                                    alt="{{ $sale->product }}">
                            </div>
                            @endforeach
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carousel-{{ $sale->id }}" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true" style="background-color: #2C3E50;"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carousel-{{ $sale->id }}" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true" style="background-color: #2C3E50;"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                    @else
                    <img src="{{ asset('images/basica.png') }}"
                        class="card-img-top"
                        style="height: 400px; object-fit: contain;">
                    @endif

                    @if($sale->isSold)
                    <div class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center justify-content-center">
                        <span class="badge bg-danger fs-3 p-2 w-100" style="transform: rotate(-45deg);">SOLD</span>
                    </div>
                    @endif
                </div>
                <div class="card-body">
                    <h5 class="card-title text-dark text-truncate">{{ $sale->product }}</h5>
                    <p class="card-text text-muted text-truncate">{{ Str::limit($sale->description, 50) }}</p>
                    <h6 class="text-primary">Price: {{ number_format($sale->price, 2, ',', '.') }}€</h6>
                    <span class="text-secondary">Category: {{ $sale->category->name }}</span> <br>
                    <span class="text-secondary">Seller: {{ $sale->user->name }}</span>
                </div>
                <div class="m-3 d-flex gap-3">
                    <button class="btn btn-primary rounded-pill" data-bs-toggle="modal" data-bs-target="#showModal-{{ $sale->id }}">
                        <i class="fas fa-info-circle"></i> More
                    </button>

                    @if(Auth::id() != $sale->user_id && !$sale->isSold)
                    <form action="{{ route('sales.shop', $sale->id) }}" method="POST" class="w-100">
                        @csrf
                        @method('PUT')
                        <button type="submit" class="btn btn-success w-100 rounded-pill"
                            onclick="return confirm('Are you sure you want to buy this product?')">
                            <i class="fas fa-cart-plus"></i> Buy Product
                        </button>
                    </form>
                    @endif

                    @if (Auth::id() == $sale->user_id)
                    <form action="{{ route('sales.destroy', $sale) }}" method="POST" class="w-100">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger w-100 rounded-pill"
                            onclick="return confirm('Are you sure you want to delete this product?')">
                            <i class="fas fa-trash"></i> Delete Product
                        </button>
                    </form>
                    <form action="{{ route('sales.edit', $sale->id) }}" method="GET" class="w-100">
                        @csrf
                        <button type="submit" class="btn btn-outline-primary w-100 rounded-pill">
                            <i class="fas fa-edit"></i> Edit Product
                        </button>
                    </form>
                    @endif
                </div>
            </div>
        </div>
        @include('sales.show-modal', ['sale' => $sale])
        @endif
        @endforeach
    </div>
</div>
@endsection

<style>
    /* Custom Styles */
    .card {
        border-radius: 16px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        background-color: #ffffff;
    }

    .card-body {
        background-color: #f9f9f9;
    }

    .btn-primary {
        background-color: #3498db;
        color: white;
        border: none;
    }

    .btn-primary:hover {
        background-color: #2980b9;
    }

    .btn-secondary {
        background-color: #8e44ad;
        color: white;
        border: none;
    }

    .btn-secondary:hover {
        background-color: #732d91;
    }

    .btn-success {
        background-color: #2ecc71;
        color: white;
        border: none;
    }

    .btn-success:hover {
        background-color: #27ae60;
    }

    .btn-danger {
        background-color: #e74c3c;
        color: white;
        border: none;
    }

    .btn-danger:hover {
        background-color: #c0392b;
    }

    .btn-outline-primary {
        border: 2px solid #3498db;
        color: #3498db;
        background-color: transparent;
    }

    .btn-outline-primary:hover {
        background-color: #3498db;
        color: white;
    }

    .badge {
        font-size: 1.5rem;
        font-weight: bold;
    }

    .text-truncate {
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
</style>
