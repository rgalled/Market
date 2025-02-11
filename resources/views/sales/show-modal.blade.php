<div class="modal fade" id="showModal-{{ $sale->id }}" tabindex="-1" aria-labelledby="modalLabel-{{ $sale->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" style="background-color: #2c3e50; color: white;">
            <div class="modal-header" style="background-color: #2980b9;">
                <h5 class="modal-title" id="modalLabel-{{ $sale->id }}">{{ $sale->product }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="color: white;"></button>
            </div>
            <div class="modal-body">
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
                                        style="height: 400px; object-fit: contain;"
                                        alt="{{ $sale->product }}">
                                </div>
                            @endforeach
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carousel-{{ $sale->id }}" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true" style="background-color: #2980b9;"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carousel-{{ $sale->id }}" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true" style="background-color: #2980b9;"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                @else
                    <img src="{{ asset('images/basica.png') }}"
                        class="card-img-top"
                        style="height: 400px; object-fit: cover;">
                @endif

                @if($sale->isSold)
                    <div class="position-absolute top-0 start-0 w-100 h-75 d-flex align-items-center justify-content-center">
                        <span class="badge bg-danger fs-1 p-10" style="transform: rotate(-45deg);">SOLD</span>
                    </div>
                @endif
                <p><strong>Description:</strong> {{ $sale->description }}</p>
                <p><strong>Published:</strong> {{ $sale->created_at->format('d/m/Y') }}</p>
                <p><strong>Price:</strong> {{ number_format($sale->price, 0, ',', '.') }}€</p>
                <p><strong>Category:</strong> {{ $sale->category->name }}</p>
                <p><strong>Seller:</strong> {{ $sale->user->name }}</p>

            </div>
            <div class="modal-footer" style="background-color: #2980b9;">
                <form action="{{ route('sales.shop', $sale) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <button type="submit" class="btn btn-warning w-100"
                        onclick="return confirm('¿Are you sure you want to buy this product?')">
                        <i class="fas fa-shopping-cart"></i> Buy Product
                    </button>
                </form>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" style="background-color: #7f8c8d; color: white;">Close</button>
            </div>
        </div>
    </div>
</div>
