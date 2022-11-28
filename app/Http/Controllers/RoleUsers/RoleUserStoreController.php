<?php

namespace App\Http\Controllers\RoleUsers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Repositories\RoleUsers\RoleUserRepository;

class RoleUserStoreController extends Controller
{

	private $repository;


	public function __construct()
	{
		$this->repository = new RoleUserRepository();
	}

	public function __invoke(Request $request)
	{
		$validator = Validator::make($request->all(), [
			'role_id'=>'required',
			'user_id'=>'required',
		]);
		if($validator->fails()){
			return $this->respondWithError('Error', $validator->errors());
		}
		$roleUser = $this->repository->setRoleUser($request->role_id, $request->user_id);
		$data = $this->repository->store($roleUser);
		return $this->respondWithData('RoleUser created', $data);
	}

}