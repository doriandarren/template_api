<?php

namespace App\Http\Controllers\Roles;

use App\Models\Roles\Role;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Roles\RoleRepository;

class RoleShowController extends Controller
{

	private $repository;


	public function __construct()
	{
		$this->repository = new RoleRepository();
	}

	public function __invoke(Role $role)
	{
		$data = $this->repository->show($role->id);
		return $this->respondWithData('Role show', $data);
	}

}
