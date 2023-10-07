<?php
namespace App\Traits;

use App\Models\OptCode;
use App\Models\Type;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

trait GeneralTrait {


    public function createOrUpdateOptCode($userID) {
        $code = 1111;
        $checkCode = OptCode::query()->where('user_id', $userID)->first();
        if (isset($checkCode)) {
            $checkCode->update([
                'code' => $code
            ]);
        }else {
            $checkCode = OptCode::query()->create([
                'code' => $code,
                'user_id' => $userID
            ]);
        }
        return $checkCode;
    }

    public function addUser($request, $Role){
        $email = $request->phone_number . "@Tadallal.com";
        $user = User::query()->create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'phone_number' => $request->phone_number,
            'email' => $email,
            'email_verified_at' => Carbon::now(),
            'password' => Hash::make($request->password),
            'role_id' => $Role,
        ]);
        return $user;
    }

    public function createType($request,$category_id){
        Type::query()->create([
            'name' => $request->name,
            'category_id' => $category_id,
        ]);
    }
}
