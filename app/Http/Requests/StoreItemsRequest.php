<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreItemsRequest extends FormRequest
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
            'item_name' => 'required|max:255',
            'item_hsn_code' => 'required|max:255',
            'item_vendor' => 'required|max:255',
            'item_description' => 'required',
            'item_gst_percentage' => 'required',
        ];
    }
}
