@extends('layouts.tabler')

@section('content')
<div class="page-body">
    @if($units->isEmpty())
        <x-empty
            title="Belum ada Satuan tersimpan"
            message="Coba cari dengan kata kunci lain atau pilih Satuan yang berbeda."
            button_label="{{ __('Tambahkan Satuan pertama') }}"
            button_route="{{ route('units.create') }}"
        />
    @else
        <div class="container-xl">
            <x-alert/>

            @livewire('tables.unit-table')
        </div>
    @endif
</div>
@endsection
