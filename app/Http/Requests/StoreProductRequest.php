<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'supplier_id'=>'required|exists:suppliers,id',
            'product_name'=>'required',
            'sku'=>'required|unique:products,sku',
            'brands_id'=>'required|exists:brands,id',
            'product_categories_id'=>'required|exists:product_categories,id',
            'description'=>'required',
            'price'=>'required|numeric',
            'branch_id'=>'required|numeric',
            'reorder_level'=>'required|integer',
            'branch_id'=>'required|numeric',
        ];
    }
}
