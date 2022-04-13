<?php

namespace App\Services\Dto;

use App\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

final class PermissionData extends DataTransferObject
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
     * @param Permission $permission
     * @return static
     */
   	public static function fromModel(Permission $permission) : self
   	{
   		return new static([
   			'id' => $permission->id,
   			'name' => $permission->name,
   			'slug' => $permission->slug,
   		]);
   	}
}
