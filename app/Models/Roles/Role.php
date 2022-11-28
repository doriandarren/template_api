<?php

namespace App\Models\Roles;

use App\Models\Abilities\Ability;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;


    const ADMIN = 'admin';
    const MANAGER = 'manager';
    const USER = 'user';

    public function abilities()
    {
        return $this->belongsToMany(Ability::class)->withTimestamps();
    }



}
