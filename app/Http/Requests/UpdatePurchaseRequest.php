<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Purchases;

class UpdatePurchaseRequest extends FormRequest
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
            'total_amount' => 'required|min:0',
            'status' => 'required|in:' . implode(',', [
    Purchases::STATUS_PENDING, 
    Purchases::STATUS_COMPLETE, 
    Purchases::STATUS_PARTIALLY_RECEIVED, 
    Purchases::STATUS_CANCELLED
            ]),
            // 'updated_by' => 'required|exists:users,id',
            'product_id'=>'required|array',
            'product_id.*'=>'required|exists:products,id',
            'quantity'=>'required|array',
            'quantity.*'=>'required|integer|min:1',
             'purchase_price'=>'required|array',
             'purchase_price.*'=>'required|numeric|min:0',
             'total_price'=>'required|array',
             'total_price.*'=>'required|numeric|min:0',
             'received_quantity'=>'required|array',
             'received_quantity.*'=>['required','numeric','min:0',
             'branch_id'=>'required|numeric',
             
             
              function ($attribute, $value, $fail) {
                    // Extract the numeric index from the field name (e.g. received_quantity.0)
                    preg_match('/\d+/', $attribute, $matches);
                    $index = $matches[0] ?? null;
                    $quantity = request()->input("quantity.$index");

                    // Only validate if corresponding quantity exists
                    if ($quantity !== null && $value > $quantity) {
                        $fail("Received quantity  cannot exceed ordered quantity.");
                    }
                },

             ]
        ];
    }
}
