<?php

namespace App\Http\Controllers\UserStatuses;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\UserStatuses\UserStatusRepository;

class UserStatusListPaginateController extends Controller
{

	private $repository;


	public function __construct()
	{
		$this->repository = new UserStatusRepository();
	}

	public function __invoke(Request $request)
	{
		$filter = $request->has('filter') ? $request->filter : null;
		$data = $this->repository->list_paginate($filter);
		return $this->respondWithData('UserStatuses paginate', $data);
	}

}