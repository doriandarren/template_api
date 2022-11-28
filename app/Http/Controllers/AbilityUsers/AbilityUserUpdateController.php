<?php

namespace App\Http\Controllers\AbilityUsers;

use App\Models\AbilityUsers\AbilityUser;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Repositories\AbilityUsers\AbilityUserRepository;

class AbilityUserUpdateController extends Controller
{

	private $repository;


	public function __construct()
	{
		$this->repository = new AbilityUserRepository();
	}

	public function __invoke(Request $request, AbilityUser $abilityUser)
	{
		$validator = Validator::make($request->all(), [
			'user_id'=>'required',
			'ability_id'=>'required',
		]);
		if($validator->fails()){
			return $this->respondWithError('Error', $validator->errors());
		}
		//$attributes = $validator->validated();
		$data = $this->repository->update($abilityUser->id, $request->all());
		return $this->respondWithData('AbilityUser updated', $data);
	}

}
