<?php

namespace App\Models\UserStatuses;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserStatus extends Model
{
    use HasFactory;

    protected $table = 'user_statuses';


    const STATUS_ACTIVE_ID = 1;
    const STATUS_INACTIVE_ID = 2;

    const STATUS_ACTIVE_NAME = 'Active';
    const STATUS_INACTIVE_NAME = 'Inactive';


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function users(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(User::class);
    }




}
