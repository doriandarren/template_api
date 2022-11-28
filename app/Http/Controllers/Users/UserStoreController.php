<?php

namespace App\Http\Controllers\Users;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Repositories\Users\UserRepository;

class UserStoreController extends Controller
{

	private $repository;


	public function __construct()
	{
		$this->repository = new UserRepository();
	}

	public function __invoke(Request $request)
	{
		$validator = Validator::make($request->all(), [
			'name'=>'required',
			'email'=>'required',
			'password'=>'required',
		]);
		if($validator->fails()){
			return $this->respondWithError('Error', $validator->errors());
		}
		$data = $this->repository->store($request->all());
		return $this->respondWithData('User created', $data);
	}

}
