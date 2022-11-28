<?php

namespace App\Http\Controllers\RoleUsers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\RoleUsers\RoleUserRepository;

class RoleUserListController extends Controller
{

	private $repository;


	public function __construct()
	{
		$this->repository = new RoleUserRepository();
	}

	public function __invoke(Request $request)
	{
		$data = $this->repository->list();
		return $this->respondWithData('RoleUsers list', $data);
	}

}