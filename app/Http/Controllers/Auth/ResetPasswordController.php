<?php

namespace App\Http\Controllers\Auth;

use App\Contracts\Models\UserContract as UserModelContract;
use App\Contracts\Repositories\UserContract;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    protected $userModelRepo;

    protected $sprookiUserRepo;

    /**
     * Create a new controller instance.
     *
     * @param UserModelContract $userModelContract
     * @param UserContract $userContract
     */
    public function __construct(UserModelContract $userModelContract, UserContract $userContract)
    {
        $this->middleware('guest');

        $this->userModelRepo = $userModelContract;

        $this->sprookiUserRepo = $userContract;
    }

    /*TODO this whole part need to be tested*/
    public function reset(Request $request)
    {
        $this->validate($request, $this->rules(), $this->validationErrorMessages());

        $data = DB::table('password_resets')->where('email', $request->get('email'))->where('token', $request->get('token'))->first();


        if (!is_null($data)) {
            $email = $request->get('email');
            $password = $request->get('password');
            $result = $this->sprookiUserRepo->resetPassword([
                "token" => $request->get("token"),
                "newpassword" => $password,
                "email" => $email
            ]);

            $user = $this->sprookiUserRepo->signIn(compact(['email', 'password']));
            $existingUser = $this->userModelRepo->getByEmail($request->get('email'));
            if (is_null($existingUser)) {
                $user->save();

            }

            $user->password = null;
            $user->save();
            $this->guard()->login($user);
            DB::table('password_resets')->where('email', $request->get('email'))->where('token', $request->get('token'))->delete();
        }
        return redirect()->back()->withErrors(['errros', ['Invalid request']]);
    }
}
