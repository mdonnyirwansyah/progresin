<?php

namespace App\Http\Requests\Web\Wallet;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class WalletUpdateRequest extends FormRequest
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
        $wallet = $this->route('wallet'); // model binding by slug

        return [
            'name' => [
                'required',
                'string',
                'max:100',
                Rule::unique('wallets', 'name')->ignore($wallet->slug, 'slug'),
            ],
            'balance' => [
                'required',
                'numeric',
                'min:0'
            ],
        ];
    }
}
