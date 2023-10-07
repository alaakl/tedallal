<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\OptCode;
use App\Models\User;
use App\Repository\UserRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class ForgetPasswordController extends Controller
{
    protected $userRepository;
    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function forgetPassword(Request $request) {
        $request->validate([
            'phone_number' => 'required|exists:users,phone_number',
        ]);
        return $this->userRepository->forgotPassword($request->phone_number);
    }

    public function checkCodeForReset(Request $request)
    {
        $request->validate([
            'code' => 'required:numeric',
            'phone_number' => 'required|exists:users,phone_number'
        ]);
        $check = $this->userRepository->checkCodeForReset($request);
        if ($check->getStatusCode() !== 200) {
            return errorResponse('Bad Request', 400);
        }
    }

    public function resetPassword(Request $request) {
        $request->validate([
            'code' => 'required:numeric',
            'phone_number' => 'required|exists:users,phone_number',
            'new_password' => 'required|string|min:8'
        ]);
        return $this->userRepository->resetPassword($request);
    }
}
