@extends('layouts.tabler')

@section('content')
<div class="page-body">
    @if($products->isEmpty())
        <x-empty
            title="Belum ada Produk tersimpan"
            message="Coba cari dengan kata kunci lain atau pilih Produk yang berbeda."
            button_label="{{ __('Tambahkan Produk pertama') }}"
            button_route="{{ route('products.create') }}"
        />
    @else
        <div class="container container-xl">
            <x-alert/>

            @livewire('tables.product-table')
        </div>
    @endif
</div>
@endsection
