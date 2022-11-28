<?php

namespace App\Http\Controllers\Users;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Repositories\Users\UserRepository;

class UserDestroyController extends Controller
{

	private $repository;


	public function __construct()
	{
		$this->repository = new UserRepository();
	}

	public function __invoke(Request $request, User $user)
	{
		$data = $this->repository->destroy($user->id);
		return $this->respondWithData('User deleted', $data);
	}
}
