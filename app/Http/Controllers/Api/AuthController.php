<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Admin;
use Validator;
use Illuminate\Http\Exceptions\HttpResponseException;


class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth:users', ['except' => ['login','register', 'refresh']]);
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request){
    	$validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string|min:6',

            'g-recaptcha-response' => 'recaptcha',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        if (! $token = auth('users')->attempt($validator->validated())) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->createNewToken($token);
    }

    /**
     * Register a User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request) {

       
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|between:2,100',
            'email' => 'required|string|email|max:100|unique:users',
            'password' => 'required|string|confirmed|min:6',

            'g-recaptcha-response' => 'recaptcha',
        ]);

        if($validator->fails()){
            // return response()->json($validator->errors()->toJson(), 400);
            $response['data']    = [];
            $response['status']  = 'NG';
            $response['summary'] = '入力に誤りがあります。';
            $response['errors']  = $validator->errors()->toArray();

            throw new HttpResponseException(
                response()->json( $response, 422 )
            );
        } 
        
        $user = User::create(array_merge(
            $request->all(),
            [
                'password' => bcrypt($request->password),
                'ovice_email' => $request->email
            ]
        ));
        
        $admin = Admin::find( 1 );

        $admin->sendEmailUserRegister($user);
        if($user){
            $user->sendEmailUserRegister($user);
        }

        $response['data']    = $user;
        $response['status']  = 'OK';
        $response['summary'] = '会員登録が完了しました。';

        return response()->json($response,201);
    }


    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout() {
        auth()->logout();

        return response()->json(['message' => 'User successfully signed out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh() {
        return $this->createNewToken(auth('users')->refresh());
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me() {
        // return response()->json(auth()->user());
        $user = User::find(Auth::id());
        $user->links = json_decode( $user->links, 1 );
        return response()->json( $user );
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function forgot_password() {
        $user = User::find(Auth::id());
        $user->links = json_decode( $user->links, 1 );
        return response()->json( $user );
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function createNewToken($token){
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('users')->factory()->getTTL() * 60
        ]);
    }

}