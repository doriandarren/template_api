<?php

namespace App\Http\Controllers\Roles;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Roles\RoleRepository;

class RoleListController extends Controller
{

	private $repository;


	public function __construct()
	{
		$this->repository = new RoleRepository();
	}

	public function __invoke(Request $request)
	{
		$data = $this->repository->list();
		return $this->respondWithData('Roles list', $data);
	}

}