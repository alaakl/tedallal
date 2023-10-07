<?php


namespace App\Repository;

use App\Http\Requests\RegisterRequest;
use App\Models\User;

interface UserRepositoryInterface
{
    public function register( $request);

    public function Login( $request);

    public function getTokenfromRefreshToken( $request);

    public function Logout( $request);

    public function update_profile( $request);

    public function forgotPassword($phoneNumber);

    public function codeVerification($request);

    public function resetPassword($request);

    public function checkCodeForReset($request);

    public function makeVerified($user);

    public function activationUserAccount(User $user);

    public function getAllClient();
}
