<?php

namespace App\Http\Controllers\Abilities;

use App\Models\Abilities\Ability;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Repositories\Abilities\AbilityRepository;

class AbilityUpdateController extends Controller
{

	private $repository;


	public function __construct()
	{
		$this->repository = new AbilityRepository();
	}

	public function __invoke(Request $request, Ability $ability)
	{
		$validator = Validator::make($request->all(), [
			'name'=>'required',
		]);
		if($validator->fails()){
			return $this->respondWithError('Error', $validator->errors());
		}
		//$attributes = $validator->validated();
		$data = $this->repository->update($ability->id, $request->all());
		return $this->respondWithData('Ability updated', $data);
	}

}
