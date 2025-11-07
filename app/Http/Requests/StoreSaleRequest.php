<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSaleRequest extends FormRequest
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
        'customer_phone'=>'required|digits:11',
        'customer_name'=>'required',
        'customer_email'=>'nullable',
        'product_id'=>'required|array',
        'paid_with'=>'required',
        'product_id.*'=>'required|exists:products,id',
        'quantity'=>'array|required',
        'quantity.*'=>'required|integer|min:1',
        'selling_price'=>'required|array',
        'selling_price.*'=>'required|numeric|min:0',
        'total_price'=>'required|array',
        'total_price.*'=>'required|numeric',
        'paid_with'=>'required|in:bkash,cash,nagad,bank,card',
        'discount'=>'required|numeric',
        'total_amount'=>'required|numeric|min:0'

        ];
    }
}
