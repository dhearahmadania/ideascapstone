<?php

namespace App\Http\Requests\Product;

use Illuminate\Support\Str;
use Illuminate\Foundation\Http\FormRequest;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class StoreProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'product_image'     => 'image|file|max:2048',
            'name'              => 'required|string',

            'slug' => 'required|string|unique:products,slug',
            'code' => 'required|string|unique:products,code',

            'category_id'       => 'required|integer',
            'unit_id'           => 'required|integer',
            'quantity'          => 'required|integer',
            'buying_price'      => 'required|integer',
            'selling_price'     => 'required|integer',
           // 'quantity_alert'    => 'required|integer',
            'tax'               => 'nullable|numeric',
            'tax_type'          => 'nullable|integer',
            'notes'             => 'nullable|max:1000'
        ];
    }


    protected function prepareForValidation(): void
    {
        $slug = Str::slug($this->name, '-');

        // Jika slug kosong atau sudah ada di database, tambahkan angka unik di belakangnya
        $count = \App\Models\Product::where('slug', 'LIKE', "$slug%")->count();
        if ($count > 0) {
            $slug .= '-' . ($count + 1);
        }

        // Pastikan hanya mengisi code jika tidak dikirim dari form
        if (!$this->has('code')) {
            $code = IdGenerator::generate([
                'table' => 'products',
                'field' => 'code',
                'length' => 6,
                'prefix' => 'ID'
            ]);
        } else {
            $code = $this->code;
        }

        $this->merge([
            'slug' => $slug,
            'code' => $code,
        ]);
    }
}
