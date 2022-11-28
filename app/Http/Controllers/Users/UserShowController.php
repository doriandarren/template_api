<?php

namespace App\Http\Controllers\Users;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Users\UserRepository;

class UserShowController extends Controller
{

	private $repository;


	public function __construct()
	{
		$this->repository = new UserRepository();
	}

	public function __invoke(User $user)
	{
		$data = $this->repository->show($user->id);
		return $this->respondWithData('User show', $data);
	}

}
