<?php

namespace App\Http\Controllers\AbilityUsers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\AbilityUsers\AbilityUserRepository;

class AbilityUserListPaginateController extends Controller
{

	private $repository;


	public function __construct()
	{
		$this->repository = new AbilityUserRepository();
	}

	public function __invoke(Request $request)
	{
		$filter = $request->has('filter') ? $request->filter : null;
		$data = $this->repository->list_paginate($filter);
		return $this->respondWithData('AbilityUsers paginate', $data);
	}

}