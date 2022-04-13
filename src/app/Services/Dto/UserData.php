<?php

namespace App\Services\Dto;

use App\Enums\UserAccount;
use App\Enums\UserStatus;
use App\Http\Requests\User\UserStoreRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

final class UserData extends DataTransferObject
{
	public string $name;
	public string $email;
	public ?string $password;
	public string $account;
	public string $status;
	public ?int $phone;
	public ?string $telegram_username;

    /**
     * @param Request $request
     * @return static
     */
	public static function fromRequest(Request $request): self
	{
		$request = $request->validated();

        return new self([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => $request['password'],
            'account' => $request['account'],
            'status' => $request['status'],
            'phone' => $request['phone'],
            'telegram_username' => $request['telegram_username'],
        ]);
    }

    /**
     * @param User $user
     * @return static
     */
   	public static function fromModel(User $user) : self
   	{
   		return new static([
   			'id' => $user->id,
   			'name' => $user->name,
   			'email' => $user->email,
   			'password' => $user->password,
   			'account' => $user->account,
   			'status' => $user->status,
   			'phone' => $user->phone,
   			'telegram_username' => $user->telegram_username,
   		]);
   	}
}
