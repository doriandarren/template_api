<?php

namespace App\Http\Controllers\Abilities;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Abilities\AbilityRepository;

class AbilityListPaginateController extends Controller
{

	private $repository;


	public function __construct()
	{
		$this->repository = new AbilityRepository();
	}

	public function __invoke(Request $request)
	{
		$filter = $request->has('filter') ? $request->filter : null;
		$data = $this->repository->list_paginate($filter);
		return $this->respondWithData('Abilities paginate', $data);
	}

}