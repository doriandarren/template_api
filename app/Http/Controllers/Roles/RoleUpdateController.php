<?php

namespace App\Http\Controllers\Roles;

use App\Models\Roles\Role;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Repositories\Roles\RoleRepository;

class RoleUpdateController extends Controller
{

	private $repository;


	public function __construct()
	{
		$this->repository = new RoleRepository();
	}

	public function __invoke(Request $request, Role $role)
	{
		$validator = Validator::make($request->all(), [
			'name'=>'required',
		]);
		if($validator->fails()){
			return $this->respondWithError('Error', $validator->errors());
		}
		//$attributes = $validator->validated();
		$data = $this->repository->update($role->id, $request->all());
		return $this->respondWithData('Role updated', $data);
	}

}
