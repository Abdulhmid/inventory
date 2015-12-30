<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Contracts\Auth\Guard;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct(Guard $auth,
                                User $users )
    {
        $this->user = $users;
        $this->auth = $auth;
        $this->middleware('guest', ['except' => 'getLogout']);
    }

    public function postLogin(Request $request) {
        $validator = \Validator::make($request->all(), ['username' => 'required',
                                                         'password' => 'required',]);
        if ($validator->fails()) {
            return redirect($this->loginPath())->withErrors($validator);
        }

        $existData = $this->user->whereUsernameOrEmail(strtolower($request->input('username')), strtolower($request->input('username')))->count();
        if ($existData < 1) {
            return redirect($this->loginPath())->withErrors([
                        'username' => 'Account not exist'
                    ]);
        }

        $credentials=array(
                'username'=>strtolower($request->username),
                'password'=>$request->password
            );

        if (filter_var($request->input('username'), FILTER_VALIDATE_EMAIL))
            $credentials=array(
                    'email'=>strtolower($request->username),
                    'password'=>$request->password
                );

        $user = $this->findUser($request->username);
        if ($user->active == 0){
            return redirect($this->loginPath())
                    ->withInput($request->only('username', 'remember'))
                    ->withErrors([
                        'username' => "Your account not activated yet.",
                    ]);
        }

        if ( $this->auth->attempt($credentials, $request->has('remember')) ){
            $this->updateLastLogin($user);
            return redirect('/');
        }

        return redirect($this->loginPath())
                    ->withInput($request->only('username', 'remember'))
                    ->withErrors([
                        'username' => $this->getFailedLoginMessage(),
                    ]);
    }

    protected function findUser($data)
    {
        return \App\User::select('id','email','active')
                          ->whereUsernameOrEmail(strtolower($data),strtolower($data))->first();
    }

    protected function updateLastLogin($user)
    {
        $user->update(['last_login' => \Carbon\Carbon::now()]);
    }

}
