<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreDonationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'donator_name' => 'required|string|max:50',
            'email' => 'required|email',
            'amount' => 'required|integer',
            'message' => 'nullable|max:140',
        ];
    }

    public function messages()
    {
        return[
            'donator_name.required' => 'Please enter a name',
            'email.required' => 'Please enter a email address',
            'amount.required' => 'Please enter an amount',
        ];
    }
}
