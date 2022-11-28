<?php

namespace App\Http\Controllers\Abilities;

use App\Models\Abilities\Ability;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Abilities\AbilityRepository;

class AbilityDestroyController extends Controller
{

	private $repository;


	public function __construct()
	{
		$this->repository = new AbilityRepository();
	}

	public function __invoke(Request $request, Ability $ability)
	{
		$data = $this->repository->destroy($ability->id);
		return $this->respondWithData('Ability deleted', $data);
	}
}
