<?php

namespace AppBundle\Model;

use AppBundle\Entity\User;
use AppBundle\Model\Command\RegisterUserCommand;

interface UserManagerInterface
{
    /**
     * @param RegisterUserCommand $command
     * @return User
     */
    public function registerUser(RegisterUserCommand $command): User;

    /**
     * @param string $username
     * @return User
     */
    public function findUser(string $username): User;
}
