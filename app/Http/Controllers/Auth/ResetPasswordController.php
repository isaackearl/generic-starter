<?php

namespace IsaacKenEarl\Http\Controllers\Auth;

use EntityManager;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Support\Str;
use IsaacKenEarl\Entities\User;
use IsaacKenEarl\Http\Controllers\Controller;

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

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * @param User $user
     * @param $password
     * @throws \Doctrine\ORM\OptimisticLockException
     * @throws \LaravelDoctrine\ORM\Facades\ORMException
     * @throws \LaravelDoctrine\ORM\Facades\ORMInvalidArgumentException
     */
    public function resetPassword($user, $password)
    {
        $user->setPassword(bcrypt($password));
        $user->setRememberToken(Str::random(60));

        EntityManager::persist($user);
        EntityManager::flush();

        $this->guard()->login($user);
    }
}
