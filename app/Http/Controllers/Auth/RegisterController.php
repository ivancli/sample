<?php

namespace App\Http\Controllers\Auth;

use App\Contracts\Repositories\UserContract;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

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
    protected $redirectTo = '/campaigns';

    protected $sprookiUserRepo;

    public static $fieldMatches = [
        'email' => 'useremail',
        'given_name' => 'givenname',
        'family_name' => 'familyname',
        'phone_no' => 'phoneno',
    ];

    /**
     * Create a new controller instance.
     *
     * @param UserContract $userContract
     * @internal param EntityRepositoryInterface $entityRepository
     */
    public function __construct(UserContract $userContract)
    {
        $this->middleware('guest');

        $this->sprookiUserRepo = $userContract;

    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        $data = $request->all();
        $data = $this->filterRequest($data);

        #region sprooki side
        /*TODO send request to Sprooki to create new user account*/
        /*sprooki does not return sessid in registration response, need to sign in to get sessid*/
        $user = $this->createThirdPartyUserAccount($data);

        if ($user !== false) {

            /*TODO login user to retrieve session token*/
            $user = $this->signInThirdPartyUserAccount([
                'email' => $user->email,
                'password' => array_get($data, 'password')
            ]);

            if ($user !== false && !is_null($user->sessid)) {
                array_set($data, 'sessid', $user->sessid);
                array_forget($data, 'password');

                event(new Registered($user = $this->create($data)));
                $this->guard()->login($user);
            }
        }
        #endregion

        return $this->registered($request, $user)
            ?: redirect($this->redirectPath());
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'given_name' => 'required|string|max:255',
            'family_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        return User::create($data);
    }

    /**
     * filter request data to have only the necessary fields
     * @param array $data
     * @return array
     */
    protected function filterRequest(array $data)
    {
        $fillables = (new User)->getFillable();
        //filter data, this step can be done within
        $data = array_only($data, $fillables);
        array_set($data, 'password', bcrypt(array_get($data, 'password')));

        return $data;
    }

    protected function createThirdPartyUserAccount(array $data)
    {
        foreach (self::$fieldMatches as $currentKey => $matchedKey) {
            if (array_has($data, $currentKey)) {
                array_set($data, $matchedKey, array_get($data, $currentKey));
                array_forget($data, $currentKey);
            }
        }

        $user = $this->sprookiUserRepo->createUser($data);
        if (is_a($user, User::class)) {
            return $user;
        }
        return false;
    }

    protected function signInThirdPartyUserAccount(array $data)
    {
        $user = $this->sprookiUserRepo->signIn($data);
        if (is_a($user, User::class)) {
            return $user;
        }
        return false;
    }
}
