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
                        Laporan Pembelian Harian - {{ today()->format('d-m-Y') }}
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
                    Daftar Pembelian
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped align-middle">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">No.</th>
                                    <th scope="col">Nama Pemasok</th>
                                    <th scope="col">No. Pembelian</th>
                                    <th scope="col">Tanggal</th>
                                    <th scope="col">Jumlah Total</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Tindakan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($purchases as $purchase)
                                <tr>
                                    <td scope="row">{{ $loop->iteration }}</td>
                                    <td>{{ $purchase->supplier->name }}</td>
                                    <td>{{ $purchase->purchase_no }}</td>
                                    <td>{{ $purchase->date ? $purchase->date->format('d-m-Y') : 'N/A' }}</td>
                                    <td>Rp {{ number_format($purchase->total_amount, 0, ',', '.') }}</td>
                                    <td>
                                    <span class="btn btn-{{ $purchase->status == 0 ? 'warning' : 'success' }} btn-sm text-uppercase">{{ $purchase->status == 0 ? 'tertunda' : 'disetujui' }}</span>
                                    </td>
                                    <td>
                                        <a href="{{ route('purchases.show', $purchase->id) }}" class="btn btn-primary btn-sm">Lihat Rincian</a>
                                    </td>
                                </tr>
                                @empty
                                    <tr>
                                        <td class="align-middle text-center" colspan="7">
                                            Tidak ada data ditemukan
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection