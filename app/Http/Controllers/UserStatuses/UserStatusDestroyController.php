<?php

namespace App\Http\Controllers\UserStatuses;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Repositories\UserStatuses\UserStatusRepository;

class UserStatusDestroyController extends Controller
{

	private $repository;


	public function __construct()
	{
		$this->repository = new UserStatusRepository();
	}

	public function __invoke(Request $request, UserStatus $userStatus)
	{
		$data = $this->repository->destroy($userStatus->id);
		return $this->respondWithData('UserStatus deleted', $data);
	}
}