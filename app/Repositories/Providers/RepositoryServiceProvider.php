<?php

namespace IsaacKenEarl\Repositories\Providers;

use EntityManager;
use Illuminate\Support\ServiceProvider;
use IsaacKenEarl\Entities\User;
use IsaacKenEarl\Repositories\Doctrine\DoctrineUserRepository;
use IsaacKenEarl\Repositories\Interfaces\UserRepository;

class RepositoryServiceProvider extends ServiceProvider
{

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

        $this->app->bind(UserRepository::class, function(){
            return new DoctrineUserRepository(
                EntityManager::getRepository(User::class)
            );
        });

       // use the example above to make the next one
    }

}