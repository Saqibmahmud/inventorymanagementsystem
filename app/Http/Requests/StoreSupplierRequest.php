<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSupplierRequest extends FormRequest
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
            'supplier_name'=>'required',
            'contact_name'=>'required',
            'phone'=>'required|min_digits:11|max_digits:11|unique:suppliers,phone',  
            'email'=>'email|nullable|unique:suppliers,email',
            'address'=>'required'

        ];
    }
}


