@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-lg rounded-4 border-0">
                <div class="card-header bg-dark text-light rounded-top">
                    <h4 class="card-title mb-0 text-center">What do you want to sell?</h4>
                </div>
                <div class="card-body">
                    @if ($errors->any())
                    <div class="alert alert-warning">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <form action="{{ route('sales.store') }}" method="POST"
                        enctype="multipart/form-data" class="needs-validation" novalidate>
                        @csrf
                        <div class="d-flex justify-content-between">

                            <div class="mb-3 w-48">
                                <label for="product" class="form-label">Name</label>
                                <input type="text" class="form-control @error('product') is-invalid @enderror"
                                    id="product" name="product" value="{{ old('product') }}" required>
                                @error('product')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3 w-48">
                                <label for="price" class="form-label">Price</label>
                                <div class="input-group">
                                    <input
                                        type="number"
                                        class="form-control @error('price') is-invalid @enderror"
                                        id="price"
                                        name="price"
                                        step="1"
                                        min="0"
                                        value="{{ old('price') }}"
                                        required>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="category_id" class="form-label">Category</label>
                            <select class="form-select @error('category_id') is-invalid @enderror"
                                id="category_id" name="category_id" required>
                                <option value="">Select one</option>
                                @foreach($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                                @endforeach
                            </select>
                            @error('category_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="images" class="form-label">Image</label>
                            <input type="file" class="form-control @error('images') is-invalid @enderror"
                                id="images" name="images[]" multiple accept="image/*">
                            @error('images')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control @error('description') is-invalid @enderror"
                                id="description" name="description" rows="4"
                                required>{{ old('description') }}</textarea>
                            @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex gap-3">
                            <button type="submit" class="btn btn-custom-primary">
                                <i class="fas fa-save"></i> Post Ad
                            </button>
                            <a href="{{ route('sales.index') }}" class="btn btn-custom-danger">
                                Cancel
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

<style>
    /* Custom CSS */
    .btn-custom-primary {
        background-color: #007bff;
        color: white;
        border-radius: 12px;
    }

    .btn-custom-primary:hover {
        background-color: #0056b3;
    }

    .btn-custom-danger {
        background-color: #dc3545;
        color: white;
        border-radius: 12px;
    }

    .btn-custom-danger:hover {
        background-color: #c82333;
    }

    .card {
        border-radius: 16px;
    }

    .card-body {
        background-color: #f8f9fa;
    }

    .input-group .form-control {
        border-radius: 8px;
    }

    .form-select, .form-control {
        border-radius: 8px;
    }

    .form-label {
        font-weight: 600;
    }

    .card-header {
        background-color: #343a40;
        border-top-left-radius: 16px;
        border-top-right-radius: 16px;
    }
</style>
