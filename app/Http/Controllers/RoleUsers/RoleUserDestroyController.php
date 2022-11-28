<?php

namespace App\Http\Controllers\RoleUsers;

use App\Models\RoleUsers\RoleUser;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\RoleUsers\RoleUserRepository;

class RoleUserDestroyController extends Controller
{

	private $repository;


	public function __construct()
	{
		$this->repository = new RoleUserRepository();
	}

	public function __invoke(Request $request, RoleUser $roleUser)
	{
		$data = $this->repository->destroy($roleUser->id);
		return $this->respondWithData('RoleUser deleted', $data);
	}
}
