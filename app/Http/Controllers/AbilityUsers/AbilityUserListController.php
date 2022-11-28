<?php

namespace App\Http\Controllers\AbilityUsers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\AbilityUsers\AbilityUserRepository;

class AbilityUserListController extends Controller
{

	private $repository;


	public function __construct()
	{
		$this->repository = new AbilityUserRepository();
	}

	public function __invoke(Request $request)
	{
		$data = $this->repository->list();
		return $this->respondWithData('AbilityUsers list', $data);
	}

}