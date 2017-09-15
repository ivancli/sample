<?php

namespace App\Http\Controllers\Auth;

use App\Contracts\Models\UserContract;
use App\Contracts\Repositories\UserContract as SprookiUserContract;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

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
    protected $redirectTo = '/coupons';

    protected $sprookiUserRepo;

    protected $userRepo;

    /**
     * Create a new controller instance.
     *
     * @param SprookiUserContract $sprookiUserContract
     * @param UserContract $userContract
     */
    public function __construct(SprookiUserContract $sprookiUserContract, UserContract $userContract)
    {
        $this->middleware('guest')->except('logout');

        $this->sprookiUserRepo = $sprookiUserContract;
        $this->userRepo = $userContract;
    }

    protected function attemptLogin(Request $request)
    {
        $user = $this->signInThirdPartyUserAccount($request->all());
        if ($user !== false) {

            /*load app user account*/
            $appUser = $this->userRepo->getByEmail($user->email);
            if (is_null($appUser)) {
                $appUser = $user;
                $appUser->save();
            }

            /*update user sessid*/
            if (!is_null($user->sessid)) {
                $appUser->sessid = $user->sessid;
                $appUser->save();
            }

            $this->guard()->login($appUser);
            return true;
        }

        return false;
//        return $this->guard()->attempt(
//            $this->credentials($request), $request->has('remember')
//        );
    }

    protected function signInThirdPartyUserAccount(array $data)
    {
        $user = $this->sprookiUserRepo->signIn($data);

        if (is_a($user, User::class)) {
            return $user;
        }
        return false;
    }

    /**
     * Log the user out of the application.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        if (!is_null(auth()->user())) {

            $result = $this->sprookiUserRepo->signOut();
            if ($result === true) {
                $this->guard()->logout();
                $request->session()->invalidate();
            }
        }


        return redirect('/');
    }
}
