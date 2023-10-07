<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Repository\UserRepositoryInterface;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;

class OptCodeController extends Controller
{
    use GeneralTrait;

    protected $userRepository;
    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function codeUpdate(Request $request){
        $user = $request->user();
        $this->createOrUpdateOptCode($user->id);
    }

    public function codeVerification(Request $request) {
        $request->validate([
            'code' => 'required:numeric',
        ]);
        return $this->userRepository->codeVerification($request);
    }
}
