<?php

namespace App\Http\Controllers\Roles;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Roles\RoleRepository;

class RoleListPaginateController extends Controller
{

	private $repository;


	public function __construct()
	{
		$this->repository = new RoleRepository();
	}

	public function __invoke(Request $request)
	{
		$filter = $request->has('filter') ? $request->filter : null;
		$data = $this->repository->list_paginate($filter);
		return $this->respondWithData('Roles paginate', $data);
	}

}