<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    protected $maxAttempts = 3;
    protected $decayMinutes = 10;
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

    public function login(Request $request)
    {
        
        // $this->validateLogin($request);
        $request->validate([
            'employee_id' => 'required|string',
            'password' => 'required|string',
        ]);
        
        if (auth()->attempt(['employee_id' => $request->employee_id, 'password' => $request->password])) {
            Alert::toast('Login Successfull', 'success');
            return redirect()->intended('home');
        } else {

            if ($this->hasTooManyLoginAttempts($request)) {

                $key = $this->throttleKey($request);
                $rateLimiter = $this->limiter();


                $limit = [3 => 10, 5 => 30];
                $attempts = $rateLimiter->attempts($key);  // return how attapts already yet

                if ($attempts >= 5) {
                    $rateLimiter->clear($key);;
                }

                if (array_key_exists($attempts, $limit)) {
                    $this->decayMinutes = $limit[$attempts];
                }

                $this->incrementLoginAttempts($request);

                $this->fireLockoutEvent($request);
                return $this->sendLockoutResponse($request);
            }

            $this->incrementLoginAttempts($request);
            return $this->sendFailedLoginResponse($request);
        }
    }


    // public function authenticate(Request $request)
    // {
    //     $credentials = $request->validate([
    //         'email' => 'required|string',
    //         'password' => 'required',
    //     ]);

    //     if (Auth::attempt($credentials)) {
    //         $request->session()->regenerate();
    //         return redirect()->intended('/dashboard');
    //     }

    //     return back()->with('loginError', 'login failed');
    // }
}
