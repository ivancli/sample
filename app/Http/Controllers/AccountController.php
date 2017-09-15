<?php

namespace App\Http\Controllers;

use App\Contracts\Repositories\UserContract;
use App\Services\AccountService;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    protected $request;

    protected $accountService;

    public function __construct(Request $request, AccountService $accountService)
    {
        $this->request = $request;
        $this->accountService = $accountService;
    }

    public function me()
    {
        /*retrieve user account from sprooki*/
        $user = $this->accountService->get();

        /*update user account in app */
        auth()->user()->update($user->toArray());
        $user = auth()->user();

        return view('account.profile')->with(compact(['user']));
    }

    public function update()
    {
        /*update user account in sprooki*/
        $user = $this->accountService->update($this->request->all());
        /*update user account in app */
        auth()->user()->update($user->toArray());

        $message = "You have updated your profile";
        return redirect()->route('coupons.list');
    }
}
