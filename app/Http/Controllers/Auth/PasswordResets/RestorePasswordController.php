<?php

namespace App\Http\Controllers\Auth\PasswordResets;

use App\Http\Controllers\Controller;
use App\Models\Auth\PasswordResets\PasswordReset;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Validator;
use Src\Api\Shared\Domain\Helpers\HelperDate;

class RestorePasswordController extends Controller
{

    public function __invoke(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'token' => 'required|string|exists:password_resets',
            'password' => 'required|string|min:6',
        ]);

        if($validator->fails()){
            return $this->respondWithError('Error', $validator->errors());
        }

        $passwordReset = PasswordReset::where('token', $request->token)->first();

        $dateExpire = HelperDate::findDateByHour($passwordReset->created_at, 1);

        if(date('Y-m-d H:i:s') > $dateExpire){
            PasswordReset::where('token', $request->token)->delete();
            return $this->respondWithError('Token is expire', []);
        }


        // find user's email
        $user = User::where('email', $passwordReset->email)->first();

        // update user password
        $user->password = bcrypt($request->password);
        $user->save();


        // delete current token
        PasswordReset::where('token', $request->token)->delete();

        return $this->respondWithData('Restore Password', []);

    }

}
