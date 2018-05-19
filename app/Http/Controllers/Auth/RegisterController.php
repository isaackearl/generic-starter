<?php

namespace IsaacKenEarl\Http\Controllers\Auth;

use EntityManager;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Validator;
use IsaacKenEarl\Entities\User;
use IsaacKenEarl\Http\Controllers\Controller;

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
     * Get a validator for an incoming registration request.
     *
     * @param  array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:IsaacKenEarl\Entities\User',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array $data
     * @return User
     * @throws \Doctrine\ORM\OptimisticLockException
     * @throws \LaravelDoctrine\ORM\Facades\ORMInvalidArgumentException
     * @throws \LaravelDoctrine\ORM\Facades\ORMException
     */
    protected function create(array $data)
    {
        $user = new User($data['name'], $data['email']);
        $user->setPassword(bcrypt($data['password']));

        EntityManager::persist($user);
        EntityManager::flush();

        return $user;
    }
}
