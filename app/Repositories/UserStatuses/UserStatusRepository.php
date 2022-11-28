<?php

namespace App\Repositories\UserStatuses;

use App\Models\UserStatuses\UserStatus;
use Src\Api\Shared\Domain\Enums\EnumSettingPaginate;

class UserStatusRepository
{

    /**
     * @inheritDoc
     */
    public function list()
    {
        return UserStatus::latest()->get();
    }

    /**
     * @inheritDoc
     */
    public function list_paginate($filter = null)
    {
        if($filter){
            return UserStatus::when($filter, function ($q) use ($filter) {
                $q->where('name', 'like', "%{$filter}%");
            })->latest()->paginate(EnumSettingPaginate::PER_PAGE);
        }else{
            return UserStatus::latest()->paginate(EnumSettingPaginate::PER_PAGE);
        }
    }

    /**
     * @inheritDoc
     */
    public function show($id)
    {
        return UserStatus::find($id);
    }

    /**
     * @inheritDoc
     */
    public function store($attributes)
    {
        if(is_array($attributes)){
            $userStatus = json_decode(json_encode($attributes), FALSE);
        }else{
            $userStatus = $attributes;
        }
        $userStatusNew = new UserStatus();
        $userStatusNew->name = $userStatus->name;
        $userStatusNew->save();
        return $userStatusNew;
    }

    /**
     * @inheritDoc
     */
    public function update($id, $attributes)
    {

        if(is_array($attributes)){
            $userStatus = json_decode(json_encode($attributes), FALSE);
        }else{
            $userStatus = $attributes;
        }
        $userStatusOld = UserStatus::find($id);

        if(isset($userStatus->name)){
            if($userStatus->name != '' && !empty($userStatus->name)){
                $userStatusOld->name = $userStatus->name;
            }
        }

        $userStatusOld->save();

        return $userStatusOld;

    }

    /**
     * @inheritDoc
     */
    public function destroy($id)
    {
        $data = UserStatus::find($id);
        $data->delete();
        return true;
    }

}
