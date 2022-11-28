<?php

namespace App\Http\Controllers\AbilityUsers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Repositories\AbilityUsers\AbilityUserRepository;

class AbilityUserStoreController extends Controller
{

	private $repository;


	public function __construct()
	{
		$this->repository = new AbilityUserRepository();
	}

	public function __invoke(Request $request)
	{
		$validator = Validator::make($request->all(), [
			'user_id'=>'required',
			'ability_id'=>'required',
		]);
		if($validator->fails()){
			return $this->respondWithError('Error', $validator->errors());
		}
		$abilityUser = $this->repository->setAbilityUser($request->user_id, $request->ability_id);
		$data = $this->repository->store($abilityUser);
		return $this->respondWithData('AbilityUser created', $data);
	}

}