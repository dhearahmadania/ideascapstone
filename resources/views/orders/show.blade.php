@extends('layouts.tabler')

@section('content')
<div class="page-body">
    <div class="container-xl">
        <div class="card">
            <div class="card-header">
                <div>
                    <h3 class="card-title">
                        {{ __('Data Pesanan') }}
                    </h3>
                </div>

                <div class="card-actions btn-actions">
                    <div class="dropdown">
                        <a href="#" class="btn-action dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><!-- Download SVG icon from http://tabler-icons.io/i/dots-vertical -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M12 12m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0"></path>
                                <path d="M12 19m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0"></path>
                                <path d="M12 5m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0"></path>
                            </svg>
                        </a>

                        <div class="dropdown-menu dropdown-menu-end">
                            @if ($order->order_status === \App\Enums\OrderStatus::PENDING)
                            <form action="{{ route('orders.update', $order) }}" method="POST">
                                @csrf
                                @method('put')

                                <button type="submit" class="dropdown-item text-success"
                                    onclick="return confirm('Apakah Anda yakin ingin menyetujui pesanan ini?')">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-check" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M5 12l5 5l10 -10" />
                                    </svg>

                                    {{ __('Pesanan Disetujui') }}
                                </button>
                            </form>
                            @endif
                        </div>
                    </div>

                    <x-action.close route="{{ route('orders.index') }}" />
                </div>
            </div>

            <div class="card-body">
                <div class="row row-cards mb-3">
                    <div class="col">
                        <label for="order_date" class="form-label required">
                            {{ __('Tanggal Pesanan') }}
                        </label>
                        <input type="text"
                            id="order_date"
                            class="form-control"
                            value="{{ $order->order_date->format('d-m-Y') }}"
                            disabled>
                    </div>

                    <div class="col">
                        <label for="invoice_no" class="form-label required">
                            {{ __('No. Invoice') }}
                        </label>
                        <input type="text"
                            id="invoice_no"
                            class="form-control"
                            value="{{ $order->invoice_no }}"
                            disabled>
                    </div>

                    <div class="col">
                        <label for="payment_type" class="form-label required">
                            {{ __('Tipe Pembayaran') }}
                        </label>

                        <input type="text" id="payment_type" class="form-control" value="{{ $order->payment_type }}" disabled>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-striped table-bordered align-middle">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col" class="align-middle text-center">No.</th>
                                <th scope="col" class="align-middle text-center">Foto</th>
                                <th scope="col" class="align-middle text-center">Nama Produk</th>
                                <th scope="col" class="align-middle text-center">Kode Produk</th>
                                <th scope="col" class="align-middle text-center">Kuantitas</th>
                                <th scope="col" class="align-middle text-center">Harga</th>
                                <th scope="col" class="align-middle text-center">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($order->details as $item)
                            <tr>
                                <td class="align-middle text-center">
                                    {{ $loop->iteration  }}
                                </td>
                                <td class="align-middle text-center">
                                    <div style="max-height: 80px; max-width: 80px;">
                                        <img class="img-fluid" src="{{ $item->product->product_image ? asset('storage/products/'.$item->product->product_image) : asset('assets/img/products/default.webp') }}">
                                    </div>
                                </td>
                                <td class="align-middle text-center">
                                    {{ $item->product->name }}
                                </td>
                                <td class="align-middle text-center">
                                    {{ $item->product->code }}
                                </td>
                                <td class="align-middle text-center">
                                    {{ $item->quantity }}
                                </td>
                                <td class="align-middle text-center">
                                    {{ number_format($item->unitcost, 2) }}
                                </td>
                                <td class="align-middle text-center">
                                    {{ number_format($item->total, 2) }}
                                </td>
                            </tr>
                            @endforeach
                            <tr>
                                <td colspan="6" class="text-end">
                                    Jumlah dibayarkan
                                </td>
                                <td class="text-center">{{ number_format($order->pay, 2) }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="card-footer text-end">
                @if ($order->order_status === \App\Enums\OrderStatus::PENDING)
                <form action="{{ route('orders.update', $order) }}" method="POST">
                    @method('put')
                    @csrf

                    <button type="submit"
                        class="btn btn-success"
                        onclick="return confirm('Apakah Anda yakin ingin menyelesaikan pesanan ini?')">
                        {{ __('Pesanan Selesai') }}
                    </button>
                </form>
                @elseif ($order->order_status === \App\Enums\OrderStatus::COMPLETE)
                <span class="badge">{{ __('Pesanan Selesai') }}</span>
                @endif
            </div>
        </div>

    </div>
</div>
@endsection