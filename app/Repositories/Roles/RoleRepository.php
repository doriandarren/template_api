<?php

namespace App\Repositories\Roles;

use App\Models\Roles\Role;
use Src\Api\Shared\Domain\Enums\EnumSettingPaginate;


class RoleRepository
{

    /**
     * @inheritDoc
     */
    public function list()
    {
        return Role::latest()->get();
    }

    /**
     * @inheritDoc
     */
    public function list_paginate($filter = null)
    {
        if($filter){
            return Role::when($filter, function ($q) use ($filter) {
                $q->where('name', 'like', "%{$filter}%")
                    ->orWhere('description', 'like', "%{$filter}%");
            })->latest()->paginate(EnumSettingPaginate::PER_PAGE);
        }else{
            return Role::latest()->paginate(EnumSettingPaginate::PER_PAGE);
        }
    }

    /**
     * @inheritDoc
     */
    public function show($id)
    {
        return Role::find($id);
    }

    /**
     * @inheritDoc
     */
    public function store($attribute)
    {
        $roleNew = new Role();
        $roleNew->name = $attribute->name;
        $roleNew->description = $attribute->description;
        $roleNew->save();
        return $roleNew;
    }
    /**
     * @inheritDoc
     */
    public function update($id, $attributes)
    {
        if(is_array($attributes)){
            $role = json_decode(json_encode($attributes), FALSE);
        }else{
            $role = $attributes;
        }
        $roleOld = Role::find($id);

        if(isset($role->name)){
            if($role->name != '' && !empty($role->name)){
                $roleOld->name = $role->name;
            }
        }

        if(isset($role->description)){
            if($role->description != '' && !empty($role->description)){
                $roleOld->description = $role->description;
            }
        }

        $roleOld->save();

        return $roleOld;

    }

    /**
     * @inheritDoc
     */
    public function destroy($id)
    {
        $data = Role::find($id);
        $data->delete();
        return true;
    }

    /**  Template
     * @param $name
     * @param $description
     * @return Role
     */

    public function setRole($name, $description	): Role
    {
        $role = new Role();
        $role->name = $name;
        $role->description = $description;
        return $role;
    }

}
