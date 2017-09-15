<?php

namespace App\Http\Controllers\Auth;

use App\Contracts\Models\UserContract as UserModelContract;
use App\Http\Controllers\Controller;
use App\Services\MailingAgentService;
use Illuminate\Auth\Passwords\TokenRepositoryInterface;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;

use App\Contracts\Repositories\UserContract as SprookiUserContract;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
    protected $userModelRepo;
    protected $mailingAgentService;


    /**
     * Create a new controller instance.
     *
     * @param SprookiUserContract $userContract
     * @param UserModelContract $userModelContract
     * @param MailingAgentService $mailingAgentService
     */
    public function __construct(SprookiUserContract $userContract, UserModelContract $userModelContract, MailingAgentService $mailingAgentService)
    {
        $this->middleware('guest');

        $this->userRepo = $userContract;
        $this->userModelRepo = $userModelContract;
        $this->mailingAgentService = $mailingAgentService;

    }

    public function sendResetLinkEmail(Request $request)
    {
        $this->validateEmail($request);

        $data = $this->userRepo->forgotPassword($request->all());


        if (isset($data->token)) {
            $this->generateToken($request->get('email'), $data->token);

            $result = $this->mailingAgentService->sendForgotPasswordEmail([
                'email' => $request->get('email'),
                'token' => $data->token
            ]);
            if ($result === true) {
                $message = "An email with reset password link has been sent to your email address. Please following the instruction to update your password.";
                $request->session()->flash('success', collect([$message]));
                return back();
            }
        }
        return redirect()->back()->withErrors(message_bag("Unable to send reset password, please contact support for more information."));
    }

    /*TODO better to create a new broker for reset password*/
    protected function generateToken($email, $token)
    {
        DB::table('password_resets')->insert(compact(['token', 'email']));
    }
}
