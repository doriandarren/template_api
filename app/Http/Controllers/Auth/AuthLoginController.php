<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Roles\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use stdClass;

class AuthLoginController extends Controller
{

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke(Request $request): \Illuminate\Http\JsonResponse
    {


        //Response 401
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
            'remember_me' => 'boolean'
        ]);


        //Response 200 but with error
        $credentials = request(['email','password']);
        if(!Auth::attempt($credentials))
        {
            return $this->respondHttpUnauthorized();
        }


        // Delete Tokens
        $user = Auth::user();
        $user->tokens()->delete();


        if(count($user->roles) == 0){
            return $this->respondWithError('User without role', ['e' => 'User without role']);
        }


        // Validate user role
        if($user->roles[0]->name == Role::ADMIN){

            $token = $user->createToken('auth_token')->plainTextToken;

        }else{

            $arr = [];
            foreach ($user->abilities as $ability) {
                $arr[] = $ability->name;
            }

            $token = $user->createToken('auth_token', $arr)->plainTextToken;

        }


        return $this->respondWithToken('Login successfully', $user, $token);

    }

}
