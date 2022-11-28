<?php

namespace App\Http\Controllers\Abilities;

use App\Models\Abilities\Ability;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Abilities\AbilityRepository;

class AbilityShowController extends Controller
{

	private $repository;


	public function __construct()
	{
		$this->repository = new AbilityRepository();
	}

	public function __invoke(Ability $ability)
	{
		$data = $this->repository->show($ability->id);
		return $this->respondWithData('Ability show', $data);
	}

}
