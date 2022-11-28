<?php

namespace App\Models\Auth\PasswordResets;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PasswordReset extends Model
{
    use HasFactory;


    protected $table = 'password_resets';
    //protected $connection = 'mysql';


}
