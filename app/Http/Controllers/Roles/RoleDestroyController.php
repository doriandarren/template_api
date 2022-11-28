<?php

namespace App\Http\Controllers\Roles;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Repositories\Roles\RoleRepository;

class RoleDestroyController extends Controller
{

	private $repository;


	public function __construct()
	{
		$this->repository = new RoleRepository();
	}

	public function __invoke(Request $request, Role $role)
	{
		$data = $this->repository->destroy($role->id);
		return $this->respondWithData('Role deleted', $data);
	}
}