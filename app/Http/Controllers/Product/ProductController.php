<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\StoreProductRequest;
use App\Http\Requests\Product\UpdateProductRequest;
use App\Models\Category;
use App\Models\Product;
use App\Models\Unit;
use Illuminate\Http\Request;
use Picqer\Barcode\BarcodeGeneratorHTML;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::select('id', 'name')
            ->limit(1)
            ->get();

        return view('products.index', [
            'products' => $products,
        ]);
    }

    public function create(Request $request)
    {
        $categories = Category::all(['id', 'name']);
        $units = Unit::all(['id', 'name']);

        if ($request->has('category')) {
            $categories = Category::whereSlug($request->get('category'))->get();
        }

        if ($request->has('unit')) {
            $units = Unit::whereSlug($request->get('unit'))->get();
        }

        return view('products.create', [
            'categories' => $categories,
            'units' => $units,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'unit_id' => 'required|exists:units,id',
            'buying_price' => 'required|numeric',
            'selling_price' => 'required|numeric',
            'quantity' => 'required|integer|min:0',
            'quantity_alert' => 'nullable|integer|min:0',
            'product_image' => 'nullable|image|mimes:jpg,png|max:2048',
            'notes' => 'nullable|string',
        ]);

        // Validasi input sudah ditangani oleh StoreProductRequest

        // Buat produk dengan data yang diterima dari request
        $product = new Product($request->all());

        // Generate kode produk otomatis
        $product->code = Product::generateCode();

        // Simpan produk ke database
        $product->save();

        // Handle upload image jika ada
        if ($request->hasFile('product_image')) {
            $file = $request->file('product_image');
            $filename = hexdec(uniqid()) . '.' . $file->getClientOriginalExtension();

            // Simpan file ke storage
            $file->storeAs('products/', $filename, 'public');

            // Update produk dengan nama file gambar
            $product->update(['product_image' => $filename]);
        }

        return redirect()
            ->route('products.index')
            ->with('berhasil', 'Produk berhasil dibuat!');
    }


    public function show(Product $product)
    {

        return view('products.show', [
            'product' => $product,
        ]);
    }

    public function edit($slug)
    {
        $product = Product::where('slug', $slug)->firstOrFail();
        $categories = Category::all();
        $units = Unit::all();

        return view('products.edit', compact('product', 'categories', 'units'));
    }


    public function update(UpdateProductRequest $request, Product $product)
    {
        $product->update($request->except('product_image'));

        if ($request->hasFile('product_image')) {

            // Delete Old Photo
            if ($product->product_image && file_exists(public_path('storage/products/') . $product->product_image)) {
                unlink(public_path('storage/products/') . $product->product_image);
            }


            // Prepare New Photo
            $file = $request->file('product_image');
            $fileName = hexdec(uniqid()) . '.' . $file->getClientOriginalExtension();

            // Store an image to Storage
            $file->storeAs('products/', $fileName, 'public');

            // Save DB
            $product->update([
                'product_image' => $fileName
            ]);
        }

        return redirect()
            ->route('products.show', $product->name)
            ->with('berhasil', 'Produk berhasil diperbarui!');
    }

    public function destroy(Product $product)
    {
        /**
         * Delete photo if exists.
         */
        if ($product->product_image) {
            unlink(public_path('storage/products/') . $product->product_image);
        }

        $product->delete();

        return redirect()
            ->route('products.index')
            ->with('berhasil', 'Produk berhasil dihapus!');
    }
}
