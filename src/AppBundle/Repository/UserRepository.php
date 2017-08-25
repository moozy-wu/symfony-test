<?php

namespace AppBundle\Repository;

use Symfony\Component\Security\Core\Exception\BadCredentialsException;
use Symfony\Component\Security\Core\User\UserInterface;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    /**
     * @inheritdoc
     * @param string $username
     * @return UserInterface
     */
    public function loadUserByUsername($username) : UserInterface
    {
        $data = $this->findBy(['username' => $username]);

        if (count($data) === 0) {
            throw new BadCredentialsException();
        }

        return $data[0];
    }
}
