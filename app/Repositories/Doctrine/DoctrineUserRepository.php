<?php

namespace IsaacKenEarl\Repositories\Doctrine;

use Doctrine\Common\Persistence\ObjectRepository;
use IsaacKenEarl\Repositories\Interfaces\UserRepository;

class DoctrineUserRepository implements UserRepository
{

    private $userRepository;

    public function __construct(ObjectRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function find($id)
    {
        return $this->userRepository->find($id);
    }

}