<?php

namespace App\Http\Controllers\UserStatuses;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Repositories\UserStatuses\UserStatusRepository;

class UserStatusStoreController extends Controller
{

	private $repository;


	public function __construct()
	{
		$this->repository = new UserStatusRepository();
	}

	public function __invoke(Request $request)
	{
		$validator = Validator::make($request->all(), [
			'name'=>'required',
		]);
		if($validator->fails()){
			return $this->respondWithError('Error', $validator->errors());
		}
		$data = $this->repository->store($request->all());
		return $this->respondWithData('UserStatus created', $data);
	}

}