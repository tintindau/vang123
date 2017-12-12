<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
//----------------------------------------------
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Http\Controllers\ApiController;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';
    protected $responseApi;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(ApiController $apiController)
    {
        $this->middleware('guest');
        $this->responseApi=$apiController;
    }
    /**
     * login
     */
    public  function logIn(Request $request)
    {
        $registerParams = Input::get();

        $credentials = $request->only('email', 'password');
        $customClaim = [];
        try {
            if (!$token = JWTAuth::attempt($credentials, $customClaim)) {
                return $this->responseApi->responseInvalidCredentials();
            }
        } catch (JWTException $e) {
            return 'not okie';
        }
      //  print_r($token);
        return $this->responseApi->response(['token'=>$token]);

    }
    /**
     * signup new user
     * @return User|array|string
     */
    public function signUp()
    {
        $vCreateUser="";
        $vErrors='success';

        $registerParams = Input::get();
        $vVerify= $this->validator($registerParams);

        if ($vVerify->fails()) {
            $vErrors= $vVerify->errors()->all();
        }else
        {
            $vCreateUser=$this->create($registerParams)  ;
            return $vCreateUser;
        }
        return $vErrors;
    }
    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
     function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|min:6',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */

    private function create(array $data)
    {

        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }
}
