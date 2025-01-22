@extends('layouts.tabler')

@section('content')
<div class="page-body">
    @if($orders->isEmpty())
    <x-empty
        title="Belum ada Pesanan tersimpan"
        message="Coba cari dengan kata kunci lain atau pilih Pesanan yang berbeda."
        button_label="{{ __('Tambahkan Pesanan pertama') }}"
        button_route="{{ route('orders.create') }}"
    />
    @else
    <div class="container-xl">
        <x-alert/>

        <livewire:tables.order-table />
    </div>
    @endif
</div>
@endsection
