<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePurchasesRequest extends FormRequest
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
            'supplier_id' => 'required|exists:suppliers,id',
            // 'purchase_date' => 'required|date',
            'total_amount' => 'required|min:0',
           // 'status' => 'required|in:pending,completed,cancelled',
            // 'created_by' => 'required|exists:users,id',
            'product_id'=>'required|array',
            'product_id.*'=>'required|exists:products,id',
            'quantity'=>'required|array',
            'quantity.*'=>'required|integer|min:1',
             'purchase_price'=>'required|array',
             'purchase_price.*'=>'required|numeric|min:0',
             'total_price'=>'required|array',
             'total_price.*'=>'required|numeric|min:0',
             'branch_id'=>'required|numeric'
        ];
    }
}
