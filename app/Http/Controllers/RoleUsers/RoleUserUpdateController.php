<?php

namespace App\Http\Controllers\RoleUsers;

use App\Models\RoleUsers\RoleUser;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Repositories\RoleUsers\RoleUserRepository;

class RoleUserUpdateController extends Controller
{

	private $repository;


	public function __construct()
	{
		$this->repository = new RoleUserRepository();
	}

	public function __invoke(Request $request, RoleUser $roleUser)
	{
		$validator = Validator::make($request->all(), [
			'role_id'=>'required',
			'user_id'=>'required',
		]);
		if($validator->fails()){
			return $this->respondWithError('Error', $validator->errors());
		}
		//$attributes = $validator->validated();
		$data = $this->repository->update($roleUser->id, $request->all());
		return $this->respondWithData('RoleUser updated', $data);
	}

}
