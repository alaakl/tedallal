<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Repository\UserRepositoryInterface;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    protected $users;

    public function __construct(UserRepositoryInterface $users)
    {
        $this->users = $users;
    }



    public function Login(LoginRequest $request)
    {
        return $this->users->Login( $request);
    }

    public function refreshToken(Request $request)
    {
        return $this->users->getTokenfromRefreshToken( $request);
    }

    public function logout(Request $request)
    {
        return $this->users->logout( $request);
    }

    public function update_profile(Request $request)
    {
        return $this->users->update_profile($request);
    }
}
