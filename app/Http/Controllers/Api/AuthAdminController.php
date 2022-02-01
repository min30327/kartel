<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Admin;
use Validator;
use App\Rules\NumDash;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;


class AuthAdminController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth:admin', ['except' => ['login', 'register', 'refresh']]);
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

        if (! $token = auth('admin')->attempt($validator->validated())) {
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
            'user_id' => 'required',
            'name' => 'required|string',
            'subname' => 'required|string',
            'email' => [
                'required','string','email','max:100',
                Rule::unique('admin', 'email')->whereNull('deleted_at')
            ],
            'password' => 'required|string|confirmed|min:6',
            'postalcode' =>  ['required','string',new NumDash()],
            'address' => 'required|string',
            'tel' => ['required','string',new NumDash()],
            'birthday' => ['required','date'],
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

        $admin = Admin::create(array_merge(
            $request->all(),
            [
                'password' => bcrypt($request->password),
                "points" => 0
            ]
        ));

        $admin = Admin::find( $admin->id );
        $user = User::find( $admin->user_id );

        
        $response['data']    = $Admin;
        $response['status']  = 'OK';
        $response['summary'] = '登録が完了しました。';

        return response()->json($response,201);
    }


    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout() {
        auth()->logout();

        return response()->json(['message' => 'Admin successfully signed out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh() {
        return $this->createNewToken(auth('admin')->refresh());
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me() {
        // return response()->json(auth()->user());
        $admin = Admin::find(Auth::id());
        return response()->json( $admin );
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function forgot_password() {
        $admin = Admin::find(Auth::id());
        return response()->json( $admin );
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
            'expires_in' => auth('admin')->factory()->getTTL() * 60
        ]);
    }

}