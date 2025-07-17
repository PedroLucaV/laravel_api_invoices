<?php

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreInvoicesRequest extends FormRequest
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
            "customer_id" => ['required', 'integer'],
            "status" => ['required', Rule::in(['B', 'P', 'V', 'b', 'p', 'v'])],
            "amount" => ['required', 'numeric'],
            'billed_date' => ['required', 'date_format:Y-m-j H:i:s'],
            'paid_date' => ['nullable', 'date_format:Y-m-j H:i:s']
        ];
    }

    protected function prepareForValidation()
    {
        
    }
}
