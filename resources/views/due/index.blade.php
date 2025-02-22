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
        <div class="card">
            <div class="card-header">
                <div>
                    <h3 class="card-title">
                        {{ __('Daftar Pesanan Belum Dibayar') }}
                    </h3>
                </div>
                <div class="card-actions">
                    <x-action.create route="{{ route('orders.create') }}" />
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered card-table table-vcenter text-nowrap datatable">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col" class="text-center">No.</th>
                            <th scope="col" class="text-center">No. Invoice</th>
                            <th scope="col" class="text-center">Tanggal</th>
                            <th scope="col" class="text-center">Pembayaran</th>
                            <th scope="col" class="text-center">Telah dibayar</th>
                            <th scope="col" class="text-center">Belum dibayar</th>
                            <th scope="col" class="text-center">Tindakan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $order)
                        <tr>
                            <td class="text-center">
                                {{ $loop->iteration }}
                            </td>
                            <td class="text-center">
                                {{ $order->invoice_no }}
                            </td>
                            <td class="text-center">
                                {{ $order->order_date->format('d-m-Y') }}
                            </td>
                            <td class="text-center">
                                {{ $order->payment_type }}
                            </td>
                            <td class="text-center">
                                <span class="badge bg-green text-white">
                                    {{ Number::currency($order->pay, 'IDR') }}
                                </span>
                            </td>
                            <td class="text-center">
                                <span class="badge bg-yellow text-white">
                                    {{ Number::currency($order->due, 'IDR') }}
                                </span>
                            </td>
                            <td class="text-center">
                                <x-button.show class="btn-icon" route="{{ route('due.show', $order) }}"/>
                                <x-button.edit class="btn-icon" route="{{ route('due.edit', $order) }}"/>
                            </td>
                        </tr>
                      @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-footer">
                {{ $orders->links() }}
            </div>
        </div>
    </div>
    @endif
</div>
@endsection
