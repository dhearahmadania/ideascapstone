<div>
    <input type="text" class="form-control mb-3" placeholder="Cari Produk..." wire:model.live="search">
    <a href="{{ route('products.create') }}" class="btn btn-success mb-3">+ Tambah Produk</a>

    <div class="row">
        @foreach ($products as $product)
        <div class="col-md-3 mb-3">
            <div class="card shadow-sm">
                <img src="{{ asset('storage/products/' . $product->product_image)  }}" class="card-img-top" alt="{{ $product->name }}" onerror="this.src='https://via.placeholder.com/150'">
                <div class="card-body">
                    <h5 class="card-title">{{ $product->name }}</h5>
                    <p class="card-text">Kode: {{ $product->code }}</p>
                    <p class="card-text">Kategori: {{ $product->category->name ?? 'Tidak Ada' }}</p>
                    <p class="card-text">Stok: {{ $product->quantity }}</p>
                    <x-button.show class="btn-icon" route="{{ route('products.show', $product) }}" />
                    <x-button.edit class="btn-icon" route="{{ route('products.edit', $product) }}" />
                    <x-button.delete class="btn-icon" route="{{ route('products.destroy', $product) }}" />
                </div>
            </div>
        </div>
        @endforeach
    </div>

    {{ $products->links() }}
</div>