@extends('layouts.tabler')

@section('content')
<div class="page-body">
    @if($categories->isEmpty())
        <x-empty
            title="Belum ada Kategori tersimpan"
            message="Coba cari dengan kata kunci lain atau pilih Kategori yang berbeda."
            button_label="{{ __('Tambahkan Kategori pertama') }}"
            button_route="{{ route('categories.create') }}"
        />
    @else
        <div class="container-xl">
            <x-alert/>

            @livewire('tables.category-table')
        </div>
    @endif
</div>
@endsection
