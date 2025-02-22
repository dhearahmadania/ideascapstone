<?php

namespace App\Livewire;

use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Livewire\Attributes\Validate;
use Livewire\Component;

class OrderForm extends Component
{
    public $cart_instance;

    private $product;

    #[Validate('Required')]
    public int $taxes = 0;

    public array $invoiceProducts = [];

    #[Validate('required', message: 'Silakan pilih produk')]
    public Collection $allProducts;

    public function mount($cartInstance): void
    {
        $this->cart_instance = $cartInstance;

        $this->allProducts = Product::all();

        //$cart_items = Cart::instance($this->cart_instance)->content();
    }

    public function render(): View
    {
        $total = 0;

        foreach ($this->invoiceProducts as $invoiceProduct) {
            if ($invoiceProduct['is_saved'] && $invoiceProduct['product_price'] && $invoiceProduct['quantity']) {
                $total += $invoiceProduct['product_price'] * $invoiceProduct['quantity'];
            }
        }

        $cart_items = Cart::instance($this->cart_instance)->content();

        return view('livewire.order-form', [
            'subtotal' => $total,
            'total' => $total * (1 + (is_numeric($this->taxes) ? $this->taxes : 0) / 100),
            'cart_items' => $cart_items,
        ]);
    }

    public function addProduct(): void
    {
        foreach ($this->invoiceProducts as $key => $invoiceProduct) {
            if (! $invoiceProduct['is_saved']) {
                $this->addError('invoiceProducts.' . $key, 'Baris ini harus disimpan sebelum membuat yang baru.');

                return;
            }
        }

        $this->invoiceProducts[] = [
            'product_id' => '',
            'quantity' => 1,
            'is_saved' => false,
            'product_name' => '',
            'product_price' => 0,
        ];
    }

    public function editProduct($index): void
    {
        foreach ($this->invoiceProducts as $key => $invoiceProduct) {
            if (! $invoiceProduct['is_saved']) {
                $this->addError('invoiceProducts.' . $key, 'Baris ini harus disimpan sebelum mengedit baris lainnya.');

                return;
            }
        }

        $this->invoiceProducts[$index]['is_saved'] = false;
    }

    public function saveProduct($index): void
    {
        $this->resetErrorBag();

        $product = $this->allProducts->find($this->invoiceProducts[$index]['product_id']);

        $this->invoiceProducts[$index]['product_name'] = $product->name;
        $this->invoiceProducts[$index]['product_price'] = $product->selling_price;
        $this->invoiceProducts[$index]['is_saved'] = true;

        $cart = Cart::instance($this->cart_instance);

        $exists = $cart->search(function ($cartItem) use ($product) {
            return $cartItem->id === $product->id;  // <-- HARUS MENGGUNAKAN ID DARI PRODUK
        });

        if ($exists->isNotEmpty()) {
            session()->flash('message', 'Produk sudah ada di keranjang!');
            return;
        }

        // Tambahkan produk ke cart dan simpan rowId-nya
        $cartItem = $cart->add([
            'id' => $product->id,
            'name' => $product->name,
            'price' => $product->selling_price,
            'qty' => $this->invoiceProducts[$index]['quantity'],
            'weight' => 1,
            'options' => ['code' => $product->code],
        ]);

        // Simpan rowId dalam invoiceProducts
        $this->invoiceProducts[$index]['rowId'] = $cartItem->rowId;
    }

    public function removeProduct($index): void
    {
        // Pastikan produk ada sebelum dihapus
        if (!isset($this->invoiceProducts[$index])) {
            return;
        }

        $product = $this->invoiceProducts[$index];

        // Hapus dari cart hanya jika rowId tersedia
        if (isset($product['rowId'])) {
            try {
                Cart::instance($this->cart_instance)->remove($product['rowId']);
            } catch (\Exception $e) {
                \Log::error("Gagal menghapus produk dari cart: " . $e->getMessage());
            }
        }

        // Hapus dari array invoiceProducts
        unset($this->invoiceProducts[$index]);
        $this->invoiceProducts = array_values($this->invoiceProducts);

        // Refresh tampilan
        $this->dispatch('refreshInvoice');
    }
}
