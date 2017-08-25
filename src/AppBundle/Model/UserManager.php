<?php

namespace AppBundle\Model;

use AppBundle\Entity\User;
use AppBundle\Model\Command\RegisterUserCommand;
use AppBundle\Repository\UserRepositoryInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserManager implements UserManagerInterface
{
    /**
     * @var UserRepositoryInterface
     */
    private $user_repository;

    /**
     * @var UserPasswordEncoderInterface
     */
    private $password_encoder;

    /**
     * UserManager constructor.
     * @param UserRepositoryInterface $user_repository UserRepository
     * @param UserPasswordEncoderInterface $password_encoder
     */
    public function __construct(UserRepositoryInterface $user_repository, UserPasswordEncoderInterface $password_encoder)
    {
        $this->user_repository = $user_repository;
        $this->password_encoder = $password_encoder;
    }

    /**
     * @param RegisterUserCommand $command
     * @return User
     */
    public function registerUser(RegisterUserCommand $command) : User
    {
        if ($command->getPassword() !== $command->getPassword2()) {
            throw new \InvalidArgumentException();
        }

        $user = new User($command->getUsername());
        $password = $this->password_encoder->encodePassword($user, $command->getPassword());
        $user->changePassword($password);
        $this->save($user);

        return $user;
    }

    /**
     * @param string $username
     * @return User
     */
    public function findUser(string $username) : User
    {
        return $this->user_repository->loadUserByUsername($username);
    }

    /**
     * @param $entity
     * @return User
     */
    private function save($entity)
    {
        return $this->user_repository->save($entity);
    }
}
