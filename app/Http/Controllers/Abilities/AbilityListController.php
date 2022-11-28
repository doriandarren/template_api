<?php

namespace App\Http\Controllers\Abilities;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Abilities\AbilityRepository;

class AbilityListController extends Controller
{

	private $repository;


	public function __construct()
	{
		$this->repository = new AbilityRepository();
	}

	public function __invoke(Request $request)
	{
		$data = $this->repository->list();
		return $this->respondWithData('Abilities list', $data);
	}

}