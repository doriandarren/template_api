<?php

namespace App\Http\Controllers\Users;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Users\UserRepository;

class UserListController extends Controller
{

	private $repository;


	public function __construct()
	{
		$this->repository = new UserRepository();
	}

	public function __invoke(Request $request)
	{

		$data = $this->repository->list();
		return $this->respondWithData('Users list', $data);
	}

}
