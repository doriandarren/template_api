<?php

namespace App\Repositories\Users;

use App\Models\User;
use App\Models\UserStatuses\UserStatus;
use Src\Api\Shared\Domain\Enums\EnumSettingPaginate;


class UserRepository
{

    /**
     * @return mixed
     */
	public function list()
    {
		return User::latest()->get();
	}

    /**
     * @param $filter
     * @return mixed
     */
	public function list_paginate($filter = null)
	{
		if($filter){
			return User::when($filter, function ($q) use ($filter) {
				$q->where('name', 'like', "%{$filter}%")
				->orWhere('email', 'like', "%{$filter}%");
			})->latest()->paginate(EnumSettingPaginate::PER_PAGE);
		}else{
			return User::latest()->paginate(EnumSettingPaginate::PER_PAGE);
		}
	}

	/**
	* @inheritDoc
	*/
	public function show($id)
	{
		return User::find($id);
	}

	/**
	* @inheritDoc
	*/
	public function store($attributes)
	{
		if(is_array($attributes)){
			$user = json_decode(json_encode($attributes), FALSE);
		}else{
			$user = $attributes;
		}
		$userNew = new User();
		$userNew->user_status_id = UserStatus::STATUS_ACTIVE_ID;
		$userNew->name = $user->name;
		$userNew->email = $user->email;
		$userNew->password = bcrypt($user->password);
		$userNew->save();
		return $userNew;
	}

	/**
	* @inheritDoc
	*/
	public function update($id, $attributes)
	{
		if(is_array($attributes)){
			$user = json_decode(json_encode($attributes), FALSE);
		}else{
			$user = $attributes;
		}
		$userOld = User::find($id);

		if($user->user_status_id != '' && !empty($user->user_status_id)){
			$userOld->user_status_id = $user->user_status_id;
		}

		if($user->name != '' && !empty($user->name)){
			$userOld->name = $user->name;
		}

		if($user->email != '' && !empty($user->email)){
			$userOld->email = $user->email;
		}

        if(isset($user->password)){
            if($user->password != '' && !empty($user->password)){
                $userOld->password = bcrypt($user->password);
            }
        }

        if(isset($user->is_edited)){
            if($user->is_edited != '' && !empty($user->is_edited)){
                $userOld->is_edited = $user->is_edited;
            }
        }


		$userOld->save();

		return $userOld;

	}

	/**
	* @inheritDoc
	*/
	public function destroy($id)
	{
		$data = User::find($id);
		$data->delete();
		return true;
	}

}
