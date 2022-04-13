<?php

namespace App\Http\Requests\Account;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use App\Enums\UserAccount;
use App\Enums\UserStatus;
use Illuminate\Validation\Rules\Enum;
use Illuminate\Validation\Rule;

class AccountUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['required', 'max:255'],
            'email' => ['required', 'email', 'email:rfc,dns', Rule::unique('users')->ignore($this->user)],
            'password' => ['sometimes'],
            'phone' => ['nullable', 'numeric'],
            'telegram_username' => ['nullable'],
        ];
    }
}
