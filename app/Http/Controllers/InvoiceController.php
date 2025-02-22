<?php

namespace App\Http\Controllers;

use App\Http\Requests\Invoice\StoreInvoiceRequest;
use Gloudemans\Shoppingcart\Facades\Cart;
use App\Models\Order;

class InvoiceController extends Controller
{
    public function create(StoreInvoiceRequest $request)
    {
        $order = Order::latest()->first();

        return view('invoices.index', [
            'carts' => Cart::instance('order')->content(),
            'order' => $order, // Tambahkan ini untuk dikirim ke view
        ]);
    }
}
