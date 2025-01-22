@extends('layouts.tabler')

@section('content')
    <div class="page-body">
        @if($quotations->isEmpty())
            <x-empty
                title="Belum ada Penawaran Harga tersimpan"
                message="Coba cari dengan kata kunci lain atau pilih Penawaran Harga yang berbeda."
                button_label="{{ __('Tambahkan Penawaran Harga pertama') }}"
                button_route="{{ route('quotations.create') }}"
            />
        @else
            <div class="container-xl">
                <x-alert/>

                @livewire('tables.quotation-table')
            </div>
        @endif
    </div>
@endsection
