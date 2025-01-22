@extends('layouts.tabler')

@section('content')
<div class="page-body">
    @if($customers->isEmpty())
        <x-empty
            title="Belum ada Pelanggan tersimpan"
            message="Coba cari dengan kata kunci lain atau pilih Pelanggan yang berbeda."
            button_label="{{ __('Tambahkan Pelanggan pertama') }}"
            button_route="{{ route('customers.create') }}"
        />
    @else
        <div class="container-xl">
            <x-alert/>

            {{---
            <div class="card">
                <div class="card-body">
                    <livewire:power-grid.customers-table/>
                </div>
            </div>
            ---}}

            @livewire('tables.customer-table')
        </div>
    @endif
</div>
@endsection
