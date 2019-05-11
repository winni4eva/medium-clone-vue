<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Exceptions\InvalidCredentialsException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use JWTAuth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    protected $jwt;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Login User
     *
     * @return mixed
     */
    public function login(Request $request)
    {
        $this->validator($request->all())->validate();

        $credentials = $request->only('email', 'password');

        if (!$token = JWTAuth::attempt($credentials)) {
            throw new InvalidCredentialsException(401);
        }

        return response()->json(compact('token'));
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make(
            $data, 
            [
                'email' => ['required', 'string', 'email'],
                'password' => ['required', 'string', 'min:3'],
            ]
        );
    }

    /**
     * Logout User
     *
     * @return mixed
     */
    public function logout()
    {
        if (JWTAuth::parseToken()->invalidate()) {
            return response()->json(
                ['success' => 'User logged out successfully...']
            );
        }
        
        return response()->json(['error' => 'Logout failed...'], 403);
    }

}
