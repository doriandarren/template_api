<?php

namespace App\Http\Controllers\UserStatuses;

use App\Models\UserStatuses\UserStatus;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\UserStatuses\UserStatusRepository;

class UserStatusShowController extends Controller
{

	private $repository;


	public function __construct()
	{
		$this->repository = new UserStatusRepository();
	}

	public function __invoke(UserStatus $userStatus)
	{
		$data = $this->repository->show($userStatus->id);
		return $this->respondWithData('UserStatus show', $data);
	}

}
