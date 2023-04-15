<?php

namespace App\Http\Controllers\Auth;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;


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
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function validator(array $data)
    {
        return Validator::make($data,
            [
                'email' => ['required','email'],
                'password' => ['required'],
            ]
        );
    }

    public function login(Request $request)
    {
        $this->validator($request->all())->validate();
        $datetimenow = Carbon::now()->format('Y-m-d h:i:s');
        $request->validate([
            'email' => ['required','email'],
            'password' => ['required']
        ]);

        $user = User::where('email', $request['email'])->first();
        if(!$user || !Hash::check($request['password'], $user->password)) {
            // throw ValidationException::withMessages([
            //     'email' => ['The provided credentials are incorrect.']
            // ]);
            $data['status'] = 401;
            $data['message'] = 'incorrect email or password';
            return response()->json($data, $data['status']);
        }

        $oauth = DB::table('oauth_access_tokens')->where('user_id', $user->id)
            ->where('expires_at', '>', $datetimenow)
            ->first();

        if(!empty($oauth)){
            $data['token'] = $user->access_token;
        } else {
            $data['token'] = $token = $user->createToken($user->name)->accessToken;
            User::where('id', $user->id)->update(['access_token' => $token]);
        }

        $data['user']   = $user;
        $data['status'] = 200;

        return response()->json($data);
    }

    public function logout(Request $request)
    {
        $user_id = $request['user_id'];
        $user = User::find($user_id);

        Auth::logout();

        $data['status'] = 200;
        $data['user'] = $user;
        return response()->json($data);
    }
}
