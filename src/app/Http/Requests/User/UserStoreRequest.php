<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use App\Enums\UserAccount;
use App\Enums\UserStatus;
use Illuminate\Validation\Rules\Enum;

class UserStoreRequest extends FormRequest
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
            // 'email' => ['required', 'unique:users', 'email:rfc,dns'],
            'email' => ['required', 'unique:users'],
            'password' => ['required'],
            'role' => ['required'],
            'permissions' => ['required'],
            'account' => [new Enum(UserAccount::class)],
            'status' => [new Enum(UserStatus::class)],
            'phone' => ['nullable', 'integer'],
            'telegram_username' => ['nullable', 'string'],
        ];
    }
}
