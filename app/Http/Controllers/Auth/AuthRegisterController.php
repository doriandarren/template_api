<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserStatuses\UserStatus;
use Illuminate\Http\Request;

class AuthRegisterController extends Controller
{


    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke(Request $request): \Illuminate\Http\JsonResponse
    {

        $request->validate([
            'name' => 'required|string',
            'email'=>'required|string|unique:users',
            'password'=>'required|string',
            'c_password' => 'required|same:password'
        ]);

        $user = new User([
            'name'  => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'user_status_id' => UserStatus::STATUS_ACTIVE_ID
        ]);


        if($user->save()){
            $tokenResult = $user->createToken('Personal Access Token');
            $token = $tokenResult->plainTextToken;
            return $this->respondWithToken('Successfully created user!', $token);
        }
        else{
            return $this->respondWithError('Provide proper details', 'Provide proper details');
        }

    }


}
