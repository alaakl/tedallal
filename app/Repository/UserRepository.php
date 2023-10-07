<?php

namespace App\Repository;

use App\Models\User;
use App\Traits\GeneralTrait;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Laravel\Passport\Client as OClient;
use GuzzleHttp\Client;
use SebastianBergmann\Diff\Exception;

class UserRepository implements UserRepositoryInterface
{
    use GeneralTrait;

    public function getTokenAndRefreshToken(OClient $oClient,$email  ,$phone_number, $password) {
        $oClient = OClient::where('password_client', 1)->first();
        $http = new   Client;
        $response = $http->request('POST', 'http://localhost:8002/oauth/token', [
            'form_params' => [
                'grant_type' => 'password',
                'client_id' => $oClient->id,
                'client_secret' => $oClient->secret,
                'phone_number' => $phone_number,
                'username' => $email,
                'password' => $password,
                'scope' => '*',
            ],
        ]);
        $life = $response->getBody();
            $json = json_decode($life, true);
            $collection = collect($json);
            return ($collection) ;
    }

    public function getTokenfromRefreshToken( $request)
    {

         try{
            $refreshToken = $request->header('refreshToken');
            $oClient = OClient::where('password_client', 1)->first();
            $http = new Client;
            $response = $http->request('POST', 'http://127.0.0.1:8002/oauth/token', [
                'form_params' => [
                    'grant_type' => 'refresh_token',
                    'refresh_token' => $refreshToken,
                    'client_id' => $oClient->id,
                    'client_secret' => $oClient->secret,
                    'scope' => '*',
                ],
            ]);
            $tokens = json_decode((string) $response->getBody(), true);
            return returnTokens($tokens);
         }
         catch (\Exception $exception) {
             return  response()->json([
                'message' => 'Bad Request'
             ], 400);
         }

    }

    public function register( $request)
    {
        try {
            $email = $request->phone_number . "@Tadallal.com";
            DB::beginTransaction();
            $user = User::create([
                'first_name'       => $request->first_name,
                'last_name'        => $request->last_name,
                'phone_number'     => $request->phone_number,
                'email'            => $email,
                'password'         =>Hash::make($request->password),
                'role_id'          => 4,
                'gender' => $request->gender
            ]);
            $this->createOrUpdateOptCode($user->id);
            DB::commit();
            $oClient = OClient::where('password_client', 1)->first();
            $collection = $this->getTokenAndRefreshToken($oClient, $email, request('phone_number'), request('password'));
            return returnTokens($collection);
        }catch (Exception $exception) {
            DB::rollBack();
            return errorResponse('Bad Request', 400);
        }

    }

    public function Login( $request)
    {
        $email = $request->phone_number . "@Tadallal.com";
        $credentials = request(['phone_number', 'password']);
        if (!Auth::attempt($credentials)){
            throw new AuthenticationException();
        }
        $oClient = OClient::where('password_client', 1)->first();
        $collection =  $this->getTokenAndRefreshToken($oClient,  $email, request('phone_number'), request('password'));

        return returnTokens($collection);
    }

    public function logout($request){
        $request->user()->token()->delete();
    }

    public function update_profile($request){
        $user = Auth::user();
        $user->first_name   = $request->first_name;
        $user->last_name    = $request->last_name;
        $user->save();
        return successResponse($user);
    }

    public function forgotPassword($phoneNumber)
    {
        $user = User::query()->where('phone_number', $phoneNumber)->first();
        if ($user) {
            $this->createOrUpdateOptCode($user->id);
        }else {
            return errorResponse('check your number', 400);
        }
    }

    public function codeVerification($request){
        $now = Carbon::now();
        $userCode = DB::table('otp_codes')
            ->where('user_id',$request->user()->id)
            ->first();
        if(!isset($userCode)){
            return errorResponse('invalid code',404);
        }
        $validateTime = Carbon::parse( $userCode->updated_at)->addMinutes(6);
        if($request->code == $userCode->code){
            DB::table('users')
                ->where('id',$request->user()->id)
                ->update([
                    'email_verified_at' => $now
                ]);
        }else{
            return errorResponse('invalid code',404);
        }
    }

    public function resetPassword($request)
    {
        $checkCode = $this->checkCodeForReset($request);
        if ($checkCode->getStatusCode() == 200) {
            $userId =  $checkCode->getData()->data->id;
            $user = User::query()->where('id', $userId)->first();
            $user->update([
                'password' => Hash::make($request->new_password)
            ]);
            $user->tokens()->delete();
            $email = $request->phone_number . "@Tadallal.com";
            $oClient = OClient::where('password_client', 1)->first();
            $collection =  $this->getTokenAndRefreshToken($oClient, $email ,request('phone_number'), request('new_password'));
            return returnTokens($collection);
        }else {
            return errorResponse('Bad Request', 400);
        }
    }

    public function checkCodeForReset($request)
    {
        $now = Carbon::now();
        $user = User::query()->where('phone_number', $request->phone_number)->first();
        if (!$user) {
            return errorResponse('invalid number', 404);
        }
        $userCode = DB::table('otp_codes')
            ->where('user_id', $user->id)
            ->where('code', $request->code)
            ->first();
        if (!isset($userCode)) {
            return errorResponse('invalid code', 404);
        }
        $validateTime = Carbon::parse($userCode->updated_at)->addMinutes(6);
        if ($request->code == $userCode->code) {
            return successResponse($user);
        }else {
            return errorResponse('invalid code', 404);
        }
    }

    public function makeVerified($user){
        $user->update([
            'email_verified_at' => Carbon::now(),
        ]);

        return successResponse($user);

    }

    public function activationUserAccount(User $user){
        if($user->email_verified_at == null){
            $user->email_verified_at = Carbon::now();
            $user->save();
            return $user;
        }
        if($user->email_verified_at !==null){
            $user->email_verified_at = null;
            $user->save();
            return $user;
        }
    }

    public function getAllClient(){
        $users = User::query()->where('role_id',4)->get();
        return $users;
    }

}
