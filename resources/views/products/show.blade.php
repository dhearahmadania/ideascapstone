@extends('layouts.tabler')

@section('content')
<div class="page-header d-print-none">
    <div class="container-xl mb-3">
        <div class="row g-2 align-items-center mb-3">
            <div class="col">
                <h2 class="page-title">
                    {{ __('Ubah Produk') }}
                </h2>
            </div>
        </div>

        @include('partials._breadcrumbs', ['model' => $product])
    </div>
</div>

<div class="page-body">
    <div class="container-xl">
        <div class="row row-cards">

            <div class="row">
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-body">
                            <h3 class="card-title">
                                {{ __('Foto Produk') }}
                            </h3>

                            <img class="img-account-profile mb-2" src="{{ asset('assets/img/products/default.webp') }}" alt="" id="image-preview" />
                        </div>
                    </div>
                </div>

                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">
                                {{ __('Data Produk') }}
                            </h3>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered card-table table-vcenter text-nowrap datatable">
                                <tbody>
                                    <tr>
                                        <td>Nama</td>
                                        <td>{{ $product->name }}</td>
                                    </tr>
                                    <tr>
                                        <td>Slug</td>
                                        <td>{{ $product->slug }}</td>
                                    </tr>
                                    <tr>
                                        <td><span class="text-secondary">Kode</span></td>
                                        <td>{{ $product->code }}</td>
                                    </tr>
                                    <tr>
                                        <td>Barcode</td>
                                        <td>{!! $barcode !!}</td>
                                    </tr>
                                    <tr>
                                        <td>Kategori</td>
                                        <td>
                                            <a href="{{ route('categories.show', $product->category) }}" class="badge bg-blue-lt">
                                                {{ $product->category->name }}
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Satuan</td>
                                        <td>
                                            <a href="{{ route('categories.show', $product->unit) }}" class="badge bg-blue-lt">
                                                {{ $product->unit->short_code }}
                                            </a>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>Kuantitas</td>
                                        <td>{{ $product->quantity }}</td>
                                    </tr>
                                    <tr>
                                        <td>Peringatan Kuantitas</td>
                                        <td>
                                            <span class="badge bg-red-lt">
                                                {{ $product->quantity_alert }}
                                            </span>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>Harga Beli</td>
                                        <td>{{ $product->buying_price }}</td>
                                    </tr>
                                    <tr>
                                        <td>Harga Jual</td>
                                        <td>{{ $product->selling_price }}</td>
                                    </tr>
                                    <tr>
                                        <td>Pajak</td>
                                        <td>
                                            <span class="badge bg-red-lt">
                                                {{ $product->tax }} %
                                            </span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Tipe Pajak</td>
                                        <td>{{ $product->tax_type->label() }}</td>
                                    </tr>
                                    <tr>
                                        <td>{{ __('Catatan') }}</td>
                                        <td>{{ $product->notes }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="card-footer text-end">
                            <x-button.edit route="{{ route('products.edit', $product) }}">
                                {{ __('Ubah') }}
                            </x-button.edit>

                            <x-button.back route="{{ route('products.index') }}">
                                {{ __('Batal') }}
                            </x-button.back>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
