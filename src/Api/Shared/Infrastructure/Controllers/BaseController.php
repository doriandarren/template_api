<?php

namespace Src\Api\Shared\Infrastructure\Controllers;

use Illuminate\Routing\Controller as IluBaseController;

class BaseController extends IluBaseController
{
    private $message;
    private $code;

    public function getMessage()
    {
        return $this->message;
    }

    public function setMessage(string $message)
    {
        $this->message = $message;
    }

    public function getCode()
    {
        return $this->code;
    }

    public function setCode(int $code)
    {
        $this->code = $code;
    }

    /**
     * Respond Base
     * @param $data
     * @param array $headers
     * @return \Illuminate\Http\JsonResponse
     */
    public function respond($data, $headers = []){
        return response()->json($data, $this->getCode());
    }

    /**
     * Respond Base with ERROR
     * @param string $message
     * @param null $errors
     * @param int $code
     * @return \Illuminate\Http\JsonResponse
     */
    public function respondWithError(string $message='', $errors = null, $code = 422)
    {
        $this->setCode($code);
        return $this->respond([
            'message' => $message,
            'errors' => $errors,
            'success' => FALSE,
            'status_code' => $this->getCode(),
        ]);
    }

    /*************************************
     *  RESPONSE 200
     *************************************/

    /**
     * Respond 200
     * @param null $message
     * @param null $data
     * @param bool $success
     * @return \Illuminate\Http\JsonResponse
     */
    public function respondWithData($message = null, $data = null, $success = true)
    {
        $this->setCode(200);
        return $this->respond([
            'data' => $data,
            'message' => $message,
            'success' => $success,
            'status_code' => 200
        ]);
    }

    /**
     * Respond with Token
     * @param $message
     * @param $accessToken
     * @param null $data
     * @return \Illuminate\Http\JsonResponse
     */
    public function respondWithToken($message, $user, $token)
    {
        $this->setCode(201);
        return $this->respond([
            'message' => $message,
            'user' => $user,
            'token' => $token,
            'token_type' => 'Bearer',
            'success' => TRUE,
            'status_code' => 201
        ]);
    }

    /*************************************
     *  RESPONSE 400
     *************************************/

    //The 400
    public function respondHttpBadRequest($message = 'Bad Request'){
        $this->setCode(400);
        return $this->respondWithError($message, ['e' => $message]);
    }

    // Response 401
    public function respondHttpUnauthorized($message = 'Unauthorized'){
        $this->setCode(401);
        return $this->respondWithError($message, ['e' => $message]);
    }

    // Response 409
    public function respondHttpConflict($message = 'Data Conflict'){
        $this->setCode(409);
        return $this->respondWithError($message, ['e' => $message]);
    }

    // Response 422
    public function respondUnprocessableEntity($message = 'Unprocessable Entity')
    {
        $this->setCode(422);
        return $this->respondWithError($message, ['e' => $message]);
    }


    /**
     * Response validate to FORM
     * Validation To Use:

    $validation =  Validator::make(
    $request->all(),
    [
    'name' => 'required',
    'email' => 'required',
    ],
    [
    'required' => [
    'error_code' => 'E001',
    'error_description' => 'Parameter :attribute is required'
    ]
    ]);

    if ($validation->fails()) {
    return $this->respondWithValidation($validation->errors());
    }

     *
     * @param $errors
     * @return \Illuminate\Http\JsonResponse
     */
    public function respondWithValidation($errors)
    {

        $errorCodes = [];
        $errorDescriptions = [];

        foreach(json_decode($errors) as $key => $error){
            if(count($errors) > 3){
                $errorCodes[] = $error[0]->error_code;
                $errorDescriptions[] = $error[0]->error_description;
            }else{
                $errorCodes = $error[0]->error_code;
                $errorDescriptions = $error[0]->error_description;
            }
        }

        $this->setCode(200);
        return $this->respond([
            'success' => false,
            'message' => '',
            'error_code' => $errorCodes,
            'error_description' => $errorDescriptions,
            'status_code' => 200,
        ]);
    }

}
