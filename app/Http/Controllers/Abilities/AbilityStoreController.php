<?php

namespace App\Http\Controllers\Abilities;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Repositories\Abilities\AbilityRepository;

class AbilityStoreController extends Controller
{

	private $repository;


	public function __construct()
	{
		$this->repository = new AbilityRepository();
	}

	public function __invoke(Request $request)
	{
		$validator = Validator::make($request->all(), [
			'name'=> 'required|unique:abilities',
		]);

		if($validator->fails()){
			return $this->respondWithError('Error', $validator->errors());
		}

		$ability = $this->repository->setAbility($request->name, $request->label);
		$data = $this->repository->store($ability);
		return $this->respondWithData('Ability created', $data);
	}

}
