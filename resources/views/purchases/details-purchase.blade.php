@extends('layouts.tabler')

@section('content')
<header class="page-header page-header-compact page-header-light border-bottom bg-white mb-4">
    <div class="container-xl px-4">
        <div class="page-header-content">
            <div class="row align-items-center justify-content-between pt-3">
                <div class="col-auto mb-3">
                    <h1 class="page-header-title">
                        <div class="page-header-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file">
                                <path d="M13 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"></path>
                                <polyline points="13 2 13 9 20 9"></polyline>
                            </svg>
                        </div>
                        Data Pembelian
                    </h1>
                </div>
            </div>
        </div>
    </div>
</header>

<div class="container-xl px-4">
    <div class="row">
        <div class="col-xl-12">
            <div class="card mb-4">
                <div class="card-header">
                    Informasi Pemasok
                </div>
                <div class="card-body">
                    <div class="row gx-3 mb-3">
                        <div class="col-md-6">
                            <label class="small mb-1">Nama</label>
                            <div class="form-control form-control-solid">{{ $purchase->supplier->name }}</div>
                        </div>
                        <div class="col-md-6">
                            <label class="small mb-1">Email</label>
                            <div class="form-control form-control-solid">{{ $purchase->supplier->email }}</div>
                        </div>
                    </div>
                    <div class="row gx-3 mb-3">
                        <div class="col-md-6">
                            <label class="small mb-1">Telepon</label>
                            <div class="form-control form-control-solid">{{ $purchase->supplier->phone }}</div>
                        </div>
                        <div class="col-md-6">
                            <label class="small mb-1">Tanggal Pemesanan</label>
                            <div class="form-control form-control-solid">{{ $purchase->date ? $purchase->date->format('d-m-Y') : 'N/A' }}</div>
                        </div>
                    </div>
                    <div class="row gx-3 mb-3">
                        <div class="col-md-6">
                            <label class="small mb-1">No. Pembelian</label>
                            <div class="form-control form-control-solid">{{ $purchase->purchase_no }}</div>
                        </div>
                        <div class="col-md-6">
                            <label class="small mb-1">Total</label>
                            <div class="form-control form-control-solid">{{ $purchase->total_amount }}</div>
                        </div>
                    </div>
                    <div class="row gx-3 mb-3">
                        <div class="col-md-6">
                            <label class="small mb-1">Dibuat Oleh</label>
                            <div class="form-control form-control-solid">{{ $purchase->createdBy ? $purchase->createdBy->name : '-' }}</div>
                        </div>
                        <div class="col-md-6">
                            <label class="small mb-1">Alamat</label>
                            <div class="form-control form-control-solid">{{ $purchase->supplier->address }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-12">
            <div class="card mb-4 mb-xl-0">
                <div class="card-header">
                    Daftar Produk
                </div>

                <div class="card-body">
                    <div class="col-lg-12">
                        <div class="table-responsive">
                            <table class="table table-striped align-middle">
                                <thead class="thead-light">
                                    <tr>
                                        <th scope="col">No.</th>
                                        <th scope="col">Foto</th>
                                        <th scope="col">Nama Produk</th>
                                        <th scope="col">Kode Produk</th>
                                        <th scope="col">Stok Saat Ini</th>
                                        <th scope="col">Kuantitas</th>
                                        <th scope="col">Harga</th>
                                        <th scope="col">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($products as $product)
                                    <tr>
                                        <td scope="row">{{ $loop->iteration }}</td>
                                        <td scope="row">
                                            <div style="max-height: 80px; max-width: 80px;">
                                                <img class="img-fluid" src="{{ $product->product->product_image ? asset('storage/products/'.$product->product->product_image) : asset('assets/img/products/default.webp') }}">
                                            </div>
                                        </td>
                                        <td scope="row">{{ $product->product->name }}</td>
                                        <td scope="row">{{ $product->product->code }}</td>
                                        <td scope="row">{{ $product->product->quantity }}</td>
                                        <td scope="row">{{ $product->quantity }}</td>
                                        <td scope="row">{{ 'Rp ' . number_format($product->unitcost, 0, ',', '.') }}</td>
                                        <td scope="row">{{ 'Rp ' . number_format($product->total, 0, ',', '.') }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div> <!-- Penutup card daftar produk -->
            </div> <!-- Penutup col-xl-12 daftar produk -->
        </div> <!-- Penutup row daftar produk -->

        <!-- Form tombol di luar daftar produk -->
        <div class="d-flex justify-content-end gap-2 mt-3">
            @if ($purchase->status == 0)
            <form action="{{ route('purchases.update', $purchase) }}" method="POST">
                @csrf
                @method('put')
                <input type="hidden" name="id" value="{{ $purchase->id }}">
                <button type="submit" class="btn btn-success" onclick="return confirm('Apakah Anda yakin ingin menyetujui pembelian ini?')">
                    Menyetujui Pembelian
                </button>
            </form>
            @elseif ($purchase->status == 1)
            <div class="alert alert-success mb-0 px-3 py-2">
                Pembelian Disetujui
            </div>
            @endif
            <a class="btn btn-primary" href="{{ URL::previous() }}">Kembali</a>
        </div>

    </div>
</div>
@endsection