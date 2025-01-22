@extends('layouts.tabler')

@section('content')
<div class="page-body">
    @if($purchases->isEmpty())
    <x-empty
        title="Belum ada Pembelian tersimpan"
        message="Coba cari dengan kata kunci lain atau pilih Pembelian yang berbeda."
        button_label="{{ __('Tambahkan Pembelian pertama') }}"
        button_route="{{ route('purchases.create') }}"
    />
    @else
    <div class="container-xl">
        <x-alert/>

        @livewire('tables.purchase-table')
    </div>
    @endif
</div>
@endsection
