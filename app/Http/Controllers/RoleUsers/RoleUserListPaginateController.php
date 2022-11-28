<?php

namespace App\Http\Controllers\RoleUsers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\RoleUsers\RoleUserRepository;

class RoleUserListPaginateController extends Controller
{

	private $repository;


	public function __construct()
	{
		$this->repository = new RoleUserRepository();
	}

	public function __invoke(Request $request)
	{
		$filter = $request->has('filter') ? $request->filter : null;
		$data = $this->repository->list_paginate($filter);
		return $this->respondWithData('RoleUsers paginate', $data);
	}

}