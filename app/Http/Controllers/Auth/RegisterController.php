<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Models\roles;
use App\Models\User;
use App\Repository\UserRepositoryInterface;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;


class RegisterController extends Controller
{
    use GeneralTrait;
    protected $user;

    public function __construct(UserRepositoryInterface $user)
    {
        $this->user = $user;
    }

    public function register(RegisterRequest $request)
    {
        return $this->user->register( $request);
    }

    public function createDashboardAccount(RegisterRequest $request)
    {
        return successResponse($this->addUser( $request, 2));//todo id=5 role= storeOnwer
    }

    public function createAdminAccount(RegisterRequest $request)
    {
        return successResponse($this->addUser( $request, 3));//todo id=5 role= storeOnwer
    }

    public function makeUserVerified(User $user)
    {
        return $this->user->makeVerified($user);
    }

    public function activationUserAccount(User $user)
    {
        return $this->user->activationUserAccount($user);
    }

    public function getAllClient()
    {
        return $this->user->getAllClient();
    }

}
