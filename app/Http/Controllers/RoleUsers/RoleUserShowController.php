<?php

namespace App\Http\Controllers\RoleUsers;

use App\Models\RoleUsers\RoleUser;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\RoleUsers\RoleUserRepository;

class RoleUserShowController extends Controller
{

	private $repository;


	public function __construct()
	{
		$this->repository = new RoleUserRepository();
	}

	public function __invoke(RoleUser $roleUser)
	{
		$data = $this->repository->show($roleUser->id);
		return $this->respondWithData('RoleUser show', $data);
	}

}
