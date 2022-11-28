<?php

namespace App\Http\Controllers\Auth\PasswordResets;

use App\Http\Controllers\Controller;
use App\Mail\SendPasswordMailable;
use App\Models\Auth\PasswordResets\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class ForgotPasswordController extends Controller
{

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke(Request $request): \Illuminate\Http\JsonResponse
    {

        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:users',
        ]);
        if($validator->fails()){
            return $this->respondWithError('Error', $validator->errors());
        }

        // Delete all old code that user send before.
        PasswordReset::where('email', $request->email)->delete();

        do{
            $token = Str::random(60);
        }while(PasswordReset::where('token', $token)->first());

        // Generate random code
        $data = new PasswordReset();
        $data->email = $request->email;
        $data->token = $token;
        $data->save();

        //Generate URL
        $link = env('APP_URL_FRONT') . '/auth/password/restore/' . $data->token;

        // Send email to user
        Mail::to($request->email)->send(new SendPasswordMailable($link));

        return $this->respondWithData('Send Password', []);

    }

}
