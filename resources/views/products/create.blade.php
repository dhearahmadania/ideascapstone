@extends('layouts.tabler')

@section('content')
<div class="page-header d-print-none">
    <div class="container-xl">
        <div class="row g-2 align-items-center mb-3">
            <div class="col">
                <h2 class="page-title">
                    {{ __('Buat Produk') }}
                </h2>
            </div>
        </div>

    </div>
</div>

<div class="page-body">
    <div class="container-xl">
        <x-alert />

        <div class="row row-cards">
            <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="row">
                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-body">
                                <h3 class="card-title">
                                    {{ __('Foto Produk') }}
                                </h3>

                                <img
                                    class="img-account-profile mb-2"
                                    src="{{ asset('assets/img/products/default.webp') }}"
                                    id="image-preview" />

                                <div class="small font-italic text-muted mb-2">
                                    Format JPG atau PNG, maksimal 2 MB
                                </div>

                                <input
                                    type="file"
                                    accept="image/*"
                                    id="image"
                                    name="product_image"
                                    class="form-control @error('product_image') is-invalid @enderror"
                                    onchange="previewImage();">

                                @error('product_image')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-8">
                        <div class="card">
                            <div class="card-header">
                                <div>
                                    <h3 class="card-title">
                                        {{ __('Buat Produk') }}
                                    </h3>
                                </div>

                                <div class="card-actions">
                                    <a href="{{ route('products.index') }}" class="btn-action">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <path d="M18 6l-12 12"></path>
                                            <path d="M6 6l12 12"></path>
                                        </svg>
                                    </a>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row row-cards">
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <x-input
                                                    name="name"
                                                    id="name"
                                                    label="Nama"
                                                    placeholder="Nama produk"
                                                    value="{{ old('name') }}"
                                                    required />
                                            </div>

                                            <div class="col-md-6">
                                                <x-input name="slug"
                                                    id="slug"
                                                    placeholder="Slug produk"
                                                    value="{{ old('slug') }}"
                                                    required />
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-6 col-md-6">
                                        <div class="mb-3">
                                            <label for="category_id" class="form-label">
                                                Kategori Produk
                                                <span class="text-danger">*</span>
                                            </label>

                                            @if ($categories->count() === 1)
                                            <select name="category_id" id="category_id"
                                                class="form-select @error('category_id') is-invalid @enderror"
                                                readonly>
                                                @foreach ($categories as $category)
                                                <option value="{{ $category->id }}" selected>
                                                    {{ $category->name }}
                                                </option>
                                                @endforeach
                                            </select>
                                            @else
                                            <select name="category_id" id="category_id"
                                                class="form-select @error('category_id') is-invalid @enderror">
                                                <option selected="" disabled="">
                                                    Pilih kategori:
                                                </option>

                                                @foreach ($categories as $category)
                                                <option value="{{ $category->id }}" @if(old('category_id')==$category->id) selected="selected" @endif>
                                                    {{ $category->name }}
                                                </option>
                                                @endforeach
                                            </select>
                                            @endif

                                            @error('category_id')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-sm-6 col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label" for="unit_id">
                                                {{ __('Satuan') }}
                                                <span class="text-danger">*</span>
                                            </label>

                                            @if ($units->count() === 1)
                                            <select name="category_id" id="category_id"
                                                class="form-select @error('category_id') is-invalid @enderror"
                                                readonly>
                                                @foreach ($units as $unit)
                                                <option value="{{ $unit->id }}" selected>
                                                    {{ $unit->name }}
                                                </option>
                                                @endforeach
                                            </select>
                                            @else
                                            <select name="unit_id" id="unit_id"
                                                class="form-select @error('unit_id') is-invalid @enderror">
                                                <option selected="" disabled="">
                                                    Pilih satuan:
                                                </option>

                                                @foreach ($units as $unit)
                                                <option value="{{ $unit->id }}" @if(old('unit_id')==$unit->id) selected="selected" @endif>{{ $unit->name }}</option>
                                                @endforeach
                                            </select>
                                            @endif

                                            @error('unit_id')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-sm-6 col-md-6">
                                        <x-input type="number"
                                            label="Harga Beli"
                                            name="buying_price"
                                            id="buying_price"
                                            placeholder="0"
                                            value="{{ old('buying_price') }}"
                                            required />
                                    </div>

                                    <div class="col-sm-6 col-md-6">
                                        <x-input type="number"
                                            label="Harga Jual"
                                            name="selling_price"
                                            id="selling_price"
                                            placeholder="0"
                                            value="{{ old('selling_price') }}"
                                            required />
                                    </div>

                                    <div class="col-sm-6 col-md-6">
                                        <x-input type="number"
                                            label="Kuantitas"
                                            name="quantity"
                                            id="quantity"
                                            placeholder="0"
                                            value="{{ old('quantity') }}"
                                            required />
                                    </div>

                                    <!--
                                    <div class="col-sm-6 col-md-6">
                                        <x-input type="number"
                                            label="Peringatan Kuantitas"
                                            name="quantity_alert"
                                            id="quantity_alert"
                                            placeholder="0"
                                            value="{{ old('quantity_alert') }}"
                                            required />
                                    </div>
-->

                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="notes" class="form-label">
                                                {{ __('Catatan') }}
                                            </label>

                                            <textarea name="notes"
                                                id="notes"
                                                rows="5"
                                                class="form-control @error('notes') is-invalid @enderror"
                                                placeholder="Catatan Produk"></textarea>

                                            @error('notes')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card-footer text-end">
                                <x-button.save type="submit">
                                    {{ __('Simpan') }}
                                </x-button.save>

                                <x-button.back route="{{ route('products.index') }}">
                                    {{ __('Batal') }}
                                </x-button.back>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@pushonce('page-scripts')
<script src="{{ asset('assets/js/img-preview.js') }}"></script>
@endpushonce

@pushonce('page-scripts')
<script>
    // Slug Generator
    const title = document.querySelector("#name");
    const slug = document.querySelector("#slug");
    title.addEventListener("keyup", function() {
        let preslug = title.value;
        preslug = preslug.replace(/ /g, "-");
        slug.value = preslug.toLowerCase();
    });
</script>
@endpushonce