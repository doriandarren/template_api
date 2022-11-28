<?php

namespace App\Repositories\RoleUsers;

use App\Models\RoleUsers\RoleUser;
use Src\Api\Shared\Domain\Enums\EnumSettingPaginate;



class RoleUserRepository
{

	/**
	* @inheritDoc
	*/
	public function list()
	{
		return RoleUser::with(['user', 'role'])
                        ->latest()
                        ->get();
	}

	/**
	* @inheritDoc
	*/
	public function list_paginate($filter = null)
	{
		if($filter){
            return RoleUser::when($filter, function ($q) use ($filter) {
				$q->where('user_id', 'like', "%{$filter}%")
				->orWhere('role_id', 'like', "%{$filter}%");
			})->latest()->with(['user', 'role'])->paginate(EnumSettingPaginate::PER_PAGE);
		}else{
			return RoleUser::with(['user', 'role'])
                            ->latest()
                            ->paginate(EnumSettingPaginate::PER_PAGE);
		}
	}

	/**
	* @inheritDoc
	*/
	public function show($id)
	{
		return RoleUser::with(['user', 'role'])
                        ->find($id);
	}

	/**
	* @inheritDoc
	*/
	public function store($attribute)
	{
		$roleUserNew = new RoleUser();
		$roleUserNew->role_id = $attribute->role_id;
		$roleUserNew->user_id = $attribute->user_id;
		$roleUserNew->save();
		return $roleUserNew;
	}


	/**
	* @inheritDoc
	*/
	public function update($id, $attributes)
	{
		if(is_array($attributes)){
			$roleUser = json_decode(json_encode($attributes), FALSE);
		}else{
			$roleUser = $attributes;
		}
		$roleUserOld = RoleUser::find($id);

		if(isset($roleUser->role_id)){
			if($roleUser->role_id != '' && !empty($roleUser->role_id)){
				$roleUserOld->role_id = $roleUser->role_id;
			}
		}

		if(isset($roleUser->user_id)){
			if($roleUser->user_id != '' && !empty($roleUser->user_id)){
				$roleUserOld->user_id = $roleUser->user_id;
			}
		}

		$roleUserOld->save();

		return $roleUserOld;

	}

	/**
	* @inheritDoc
	*/
	public function destroy($id)
	{
		$data = RoleUser::find($id);
		$data->delete();
		return true;
	}

	/**  Template
	 * @param $role_id
	 * @param $user_id
	 * @return RoleUser
	 */

	public function setRoleUser($role_id, $user_id	): RoleUser
	{
		$roleUser = new RoleUser();
		$roleUser->role_id = $role_id;
		$roleUser->user_id = $user_id;
		return $roleUser;
	}

}
