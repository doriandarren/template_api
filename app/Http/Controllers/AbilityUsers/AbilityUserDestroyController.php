<?php

namespace App\Http\Controllers\AbilityUsers;

use App\Models\AbilityUsers\AbilityUser;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\AbilityUsers\AbilityUserRepository;

class AbilityUserDestroyController extends Controller
{

	private $repository;


	public function __construct()
	{
		$this->repository = new AbilityUserRepository();
	}

	public function __invoke(Request $request, AbilityUser $abilityUser)
	{
		$data = $this->repository->destroy($abilityUser->id);
		return $this->respondWithData('AbilityUser deleted', $data);
	}
}
