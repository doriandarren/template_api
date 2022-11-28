<?php

namespace App\Http\Controllers\AbilityUsers;

use App\Models\AbilityUsers\AbilityUser;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\AbilityUsers\AbilityUserRepository;

class AbilityUserShowController extends Controller
{

	private $repository;


	public function __construct()
	{
		$this->repository = new AbilityUserRepository();
	}

	public function __invoke(AbilityUser $abilityUser)
	{
		$data = $this->repository->show($abilityUser->id);
		return $this->respondWithData('AbilityUser show', $data);
	}

}
