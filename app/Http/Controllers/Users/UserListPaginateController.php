<?php

namespace App\Http\Controllers\Users;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Users\UserRepository;

class UserListPaginateController extends Controller
{

	private $repository;


	public function __construct()
	{
		$this->repository = new UserRepository();
	}

	public function __invoke(Request $request)
	{
		$filter = $request->has('filter') ? $request->filter : null;
		$data = $this->repository->list_paginate($filter);
		return $this->respondWithData('Users paginate', $data);
	}

}