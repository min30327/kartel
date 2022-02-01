<?php

namespace App\Http\Controllers\Api;

use App\Models\Customer;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\ResetsPasswords;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Contracts\Auth\PasswordBroker;
use Illuminate\Http\JsonResponse;

class AdminResetPasswordController extends Controller
{
    use ResetsPasswords;
    protected $redirectTo = '/home';

    public function __construct()
    {
        $this->middleware('guest');
    }
    
    public function broker()
    {
        return Password::broker('admin');
    }

    // 追加
    public function reset(Request $request)
    {
        $validate = $this->validator($request->all());

        if ($validate->fails()) {
            return new JsonResponse(
                [
                    'status'=>'error',
                    'message'=>'',
                    'errors' => $validate->errors()->toArray()
                ]
            );
        }
        $response = $this->broker()->reset(
            $this->credentials($request), function ($user, $password) {
                $this->resetPassword($user, $password);
            }
        );
        return $response == Password::PASSWORD_RESET
                    ? $this->sendResetResponse($request, $response)
                    : $this->sendResetFailedResponse($request, $response);
    }

    protected function resetPassword($user, $password)
    {
        $user->sendPasswordResetCompleteNotification();
        $user->forceFill([
            'password' => bcrypt($password),
            'remember_token' => Str::random(60),
        ])->save();
    }

    protected function sendResetResponse(Request $request, $response)
    {

        return new JsonResponse([
            'status'=>'success',
            'message'=> 'パスワードをリセットしました。'
        ]);
    }

    protected function sendResetFailedResponse(Request $request, $response)
    {
        return new JsonResponse([
            'status'=>'error',
            'message'=>$response
        ]);
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'token' => 'required',
            'password' => 'required|confirmed|min:6',
        ]);
    }
}