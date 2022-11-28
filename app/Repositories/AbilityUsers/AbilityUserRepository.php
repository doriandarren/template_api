<?php

namespace App\Repositories\AbilityUsers;


use App\Models\AbilityUsers\AbilityUser;
use Src\Api\Shared\Domain\Enums\EnumSettingPaginate;



class AbilityUserRepository
{

	/**
	* @inheritDoc
	*/
	public function list()
	{
		return AbilityUser::with(['user', 'ability'])
                            ->latest()
                            ->get();
	}

	/**
	* @inheritDoc
	*/
	public function list_paginate($filter = null)
	{
		if($filter){
			return AbilityUser::when($filter, function ($q) use ($filter) {
				$q->where('user_id', 'like', "%{$filter}%")
				->orWhere('ability_id', 'like', "%{$filter}%");
			})->with(['user', 'ability'])->latest()->paginate(EnumSettingPaginate::PER_PAGE);
		}else{
			return AbilityUser::with(['user', 'ability'])
                                ->latest()
                                ->paginate(EnumSettingPaginate::PER_PAGE);
		}
	}

	/**
	* @inheritDoc
	*/
	public function show($id)
	{
		return AbilityUser::with(['user', 'ability'])->find($id);
	}

	/**
	* @inheritDoc
	*/
	public function store($attribute)
	{
		$abilityUserNew = new AbilityUser();
		$abilityUserNew->user_id = $attribute->user_id;
		$abilityUserNew->ability_id = $attribute->ability_id;
		$abilityUserNew->save();
		return $abilityUserNew;
	}
	/**
	* @inheritDoc
	*/
	public function update($id, $attributes)
	{
		if(is_array($attributes)){
			$abilityUser = json_decode(json_encode($attributes), FALSE);
		}else{
			$abilityUser = $attributes;
		}
		$abilityUserOld = AbilityUser::find($id);

		if(isset($abilityUser->user_id)){
			if($abilityUser->user_id != '' && !empty($abilityUser->user_id)){
				$abilityUserOld->user_id = $abilityUser->user_id;
			}
		}

		if(isset($abilityUser->ability_id)){
			if($abilityUser->ability_id != '' && !empty($abilityUser->ability_id)){
				$abilityUserOld->ability_id = $abilityUser->ability_id;
			}
		}

		$abilityUserOld->save();

		return $abilityUserOld;

	}

	/**
	* @inheritDoc
	*/
	public function destroy($id)
	{
		$data = AbilityUser::find($id);
		$data->delete();
		return true;
	}

	/**  Template
	 * @param $user_id
	 * @param $ability_id
	 * @return AbilityUser
	 */

	public function setAbilityUser($user_id, $ability_id	): AbilityUser
	{
		$abilityUser = new AbilityUser();
		$abilityUser->user_id = $user_id;
		$abilityUser->ability_id = $ability_id;
		return $abilityUser;
	}

}
