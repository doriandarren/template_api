<?php

namespace App\Http\Controllers\Users;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Repositories\Users\UserRepository;

class UserUpdateController extends Controller
{

	private $repository;


	public function __construct()
	{
		$this->repository = new UserRepository();
	}

	public function __invoke(Request $request, User $user)
	{
		$validator = Validator::make($request->all(), [
			'user_status_id'=>'required',
			'name'=>'required',
			'email'=>'required',
		]);
		if($validator->fails()){
			return $this->respondWithError('Error', $validator->errors());
		}
		//$attributes = $validator->validated();
		$data = $this->repository->update($user->id, $request->all());
		return $this->respondWithData('User updated', $data);
	}

}
