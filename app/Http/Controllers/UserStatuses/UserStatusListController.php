<?php

namespace App\Http\Controllers\UserStatuses;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\UserStatuses\UserStatusRepository;

class UserStatusListController extends Controller
{

	private $repository;


	public function __construct()
	{
		$this->repository = new UserStatusRepository();
	}

	public function __invoke(Request $request)
	{
		$data = $this->repository->list();
		return $this->respondWithData('UserStatuses list', $data);
	}

}