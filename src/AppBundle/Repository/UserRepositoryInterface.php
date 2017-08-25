<?php

namespace AppBundle\Repository;

use Symfony\Bridge\Doctrine\Security\User\UserLoaderInterface;

interface UserRepositoryInterface extends UserLoaderInterface, RepositoryInterface
{
}
