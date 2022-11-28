<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use stdClass;

class AuthUserController extends Controller
{



    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke(Request $request): \Illuminate\Http\JsonResponse
    {

        $data = new stdClass();
        $data->user = $request->user();
        $data->user->abilities = $request->user()->abilities;
        $data->user->roles = $request->user()->roles;
        return $this->respondWithData("User", $data->user);

    }


}
