<?php

namespace App\Repositories\Abilities;

use App\Models\Abilities\Ability;
use Src\Api\Shared\Domain\Enums\EnumSettingPaginate;


class AbilityRepository
{

	/**
	* @inheritDoc
	*/
	public function list()
	{
		return Ability::latest()->get();
	}

	/**
	* @inheritDoc
	*/
	public function list_paginate($filter = null)
	{
		if($filter){
			return Ability::when($filter, function ($q) use ($filter) {
				$q->where('name', 'like', "%{$filter}%")
				->orWhere('label', 'like', "%{$filter}%");
			})->latest()->paginate(EnumSettingPaginate::PER_PAGE);
		}else{
			return Ability::latest()->paginate(EnumSettingPaginate::PER_PAGE);
		}
	}

	/**
	* @inheritDoc
	*/
	public function show($id)
	{
		return Ability::find($id);
	}

	/**
	* @inheritDoc
	*/
	public function store($attribute)
	{
		$abilityNew = new Ability();
		$abilityNew->name = $attribute->name;
		$abilityNew->label = $attribute->label;
		$abilityNew->save();
		return $abilityNew;
	}
	/**
	* @inheritDoc
	*/
	public function update($id, $attributes)
	{
		if(is_array($attributes)){
			$ability = json_decode(json_encode($attributes), FALSE);
		}else{
			$ability = $attributes;
		}
		$abilityOld = Ability::find($id);

		if(isset($ability->name)){
			if($ability->name != '' && !empty($ability->name)){
				$abilityOld->name = $ability->name;
			}
		}

		if(isset($ability->label)){
			if($ability->label != '' && !empty($ability->label)){
				$abilityOld->label = $ability->label;
			}
		}

		$abilityOld->save();

		return $abilityOld;

	}

	/**
	* @inheritDoc
	*/
	public function destroy($id)
	{
		$data = Ability::find($id);
		$data->delete();
		return true;
	}

	/**  Template
	 * @param $name
	 * @param $label
	 * @return Ability
	 */
	public function setAbility($name, $label): Ability
	{
		$ability = new Ability();
		$ability->name = $name;
		$ability->label = $label;
		return $ability;
	}

}
