<?php

namespace App\Http\Controllers\UserStatuses;

use App\Models\UserStatuses\UserStatus;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Repositories\UserStatuses\UserStatusRepository;

class UserStatusUpdateController extends Controller
{

	private $repository;


	public function __construct()
	{
		$this->repository = new UserStatusRepository();
	}

	public function __invoke(Request $request, UserStatus $userStatus)
	{
		$validator = Validator::make($request->all(), [
			'name'=>'required',
		]);
		if($validator->fails()){
			return $this->respondWithError('Error', $validator->errors());
		}
		//$attributes = $validator->validated();
		$data = $this->repository->update($userStatus->id, $request->all());
		return $this->respondWithData('UserStatus updated', $data);
	}

}
