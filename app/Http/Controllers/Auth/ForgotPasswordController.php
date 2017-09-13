<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;

use App\Contracts\Repositories\UserContract as SprookiUserContract;
use Illuminate\Http\Request;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    protected $userRepo;

    /**
     * Create a new controller instance.
     *
     * @param SprookiUserContract $userContract
     */
    public function __construct(SprookiUserContract $userContract)
    {
        $this->middleware('guest');

        $this->userRepo = $userContract;
    }

    public function sendResetLinkEmail(Request $request)
    {
        $this->userRepo->forgotPassword($request->all());
    }
}
