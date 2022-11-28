<?php

namespace App\Http\Controllers\Roles;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Repositories\Roles\RoleRepository;

class RoleStoreController extends Controller
{

	private $repository;


	public function __construct()
	{
		$this->repository = new RoleRepository();
	}

	public function __invoke(Request $request)
	{
		$validator = Validator::make($request->all(), [
			'name'=>'required',
		]);
		if($validator->fails()){
			return $this->respondWithError('Error', $validator->errors());
		}
		$role = $this->repository->setRole($request->name, $request->description);
		$data = $this->repository->store($role);
		return $this->respondWithData('Role created', $data);
	}

}
