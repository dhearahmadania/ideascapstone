<!DOCTYPE html>
<html lang="en">
<head>
    <title>Inventori</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">

    <!-- External CSS libraries -->
    <link type="text/css" rel="stylesheet" href="{{ asset('assets/invoice/css/bootstrap.min.css') }}">

    <!-- Google fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Custom Stylesheet -->
    <link type="text/css" rel="stylesheet" href="{{ asset('assets/invoice/css/style.css') }}">
</head>
<body>
    <div class="invoice-16 invoice-content">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <!-- BEGIN: Invoice Details -->
                    <div class="invoice-inner-9" id="invoice_wrapper">
                        <div class="invoice-top">
                            <div class="row">
                                <div class="col-lg-6 col-sm-6">
                                    <div class="logo">
                                        <h1>Toko Buah Bu Har</h1>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="invoice-info">
                            <div class="row">
                                <div class="col-sm-6 mb-50">
                                    <div class="invoice-number">
                                        <h4 class="inv-title-1">Tanggal invoice:</h4>
                                        <p class="invo-addr-1">
                                            {{ Carbon\Carbon::now()->format('M d, Y') }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6 text-end mb-50">
                                    <h4 class="inv-title-1">Toko</h4>
                                    <p class="inv-from-1">Buah Bu Har</p>
                                    <p class="inv-from-1">(+62) 123 123 123</p>
                                    <p class="inv-from-1">buhar@email.com</p>
                                    <p class="inv-from-2">Semarang, Jawa Tengah, Indonesia</p>
                                </div>
                            </div>
                        </div>
                        <div class="order-summary">
                            <div class="table-outer">
                                <table class="default-table invoice-table">
                                    <thead>
                                        <tr>
                                            <th class="text-center">Barang</th>
                                            <th class="text-center">Harga</th>
                                            <th class="text-center">Kuantitas</th>
                                            <th class="text-center">Subtotal</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($carts as $item)
                                        <tr>
                                            <td class="text-center">{{ $item->name }}</td>
                                            <td class="text-center">{{ $item->price }}</td>
                                            <td class="text-center">{{ $item->qty }}</td>
                                            <td class="text-center">{{ $item->subtotal }}</td>
                                        </tr>
                                        @endforeach
                                        <tr>
                                            <td colspan="3" class="text-end"><strong>Total</strong></td>
                                            <td class="text-center">
                                                <strong>{{ Cart::subtotal() }}</strong>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        {{-- <div class="invoice-informeshon-footer">
                            <ul>
                                <li><a href="#">www.website.com</a></li>
                                <li><a href="mailto:sales@hotelempire.com">info@example.com</a></li>
                                <li><a href="tel:+088-01737-133959">+62 123 123 123</a></li>
                            </ul>
                        </div> --}}
                    </div>
                    <!-- END: Invoice Details -->

                    <!-- BEGIN: Invoice Button -->
                    <div class="invoice-btn-section clearfix d-print-none">
                        <a class="btn btn-lg btn-primary" href="{{ route('orders.index') }}">
                            {{ __('Kembali') }}
                        </a>

                        <button class="btn btn-lg btn-download" type="button" data-bs-toggle="modal" data-bs-target="#modal">
                            {{ __('Bayar Sekarang') }}
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title text-center mx-auto" id="modalCenterTitle">Jumlah Total Rp.{{ Cart::subtotal() }}</h3>
                </div>

                <form action="{{ route('orders.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="modal-body">
                            <div class="mb-3">
                                <!-- Form Group (type of product category) -->
                                <label class="small mb-1" for="payment_type">Tipe Pembayaran <span class="text-danger">*</span></label>
                                <select class="form-control @error('payment_type') is-invalid @enderror" id="payment_type" name="payment_type">
                                    <option selected="" disabled="">Pilih pembayaran:</option>
                                    <option value="Tunai">Tunai</option>
                                    <option value="QRIS">QRIS</option>
                                </select>
                                @error('payment_type')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="small mb-1" for="pay">Nominal Bayar<span class="text-danger">*</span></label>
                                <input type="text" class="form-control form-control-solid @error('pay') is-invalid @enderror" id="pay" name="pay" placeholder="" value="{{ old('pay') }}" autocomplete="off"/>
                                @error('pay')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button class="btn btn-lg btn-danger" type="button" data-bs-dismiss="modal">
                            Batal
                        </button>
                        <button class="btn btn-lg btn-download" type="submit">
                            Bayar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>

</body>
</html>
