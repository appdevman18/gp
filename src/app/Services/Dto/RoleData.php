<?php

namespace App\Services\Dto;

use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

final class RoleData extends DataTransferObject
{
	public string $name;
	public string $slug;

    /**
     * @param Request $request
     * @return static
     */
	public static function fromRequest(Request $request): self
	{
		$request = $request->validated();

        return new self([
            'name' => $request['name'],
            'slug' => Str::slug($request['name']),
        ]);
    }

    /**
     * @param Role $role
     * @return static
     */
   	public static function fromModel(Role $role) : self
   	{
   		return new static([
   			'id' => $role->id,
   			'name' => $role->name,
   			'slug' => $role->slug,
   		]);
   	}
}
