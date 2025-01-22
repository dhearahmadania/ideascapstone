@extends('layouts.tabler')

@section('content')
<div class="page-body">
    @if($suppliers->isEmpty())
        <x-empty
            title="Belum ada Pemasok tersimpan"
            message="Coba cari dengan kata kunci lain atau pilih Pemasok yang berbeda."
            button_label="{{ __('Tambahkan Pemasok pertama') }}"
            button_route="{{ route('suppliers.create') }}"
        />
    @else
        <div class="container-xl">
            <x-alert/>

            @livewire('tables.supplier-table')
        </div>
    @endif
</div>
@endsection
