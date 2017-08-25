<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Security\Core\User\UserInterface;

class User implements UserInterface
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $username;

    /**
     * @var string
     */
    private $password;

    /**
     * @var \DateTime
     */
    private $created_at;

    /**
     * @var Post[]
     */
    private $posts;

    /**
     * @var bool
     */
    private $admin;

    /**
     * User constructor.
     * @param string $username username
     */
    public function __construct(string $username)
    {
        $this->username = $username;
        $this->posts = new ArrayCollection();
        $this->created_at = new \DateTime();
        $this->admin = false;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @inheritdoc
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @param string $password
     * @return User
     */
    public function changePassword(string $password) : User
    {
        $this->password = $password;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedAt(): \DateTime
    {
        return $this->created_at;
    }

    /**
     * @return Post[]
     */
    public function getPosts(): array
    {
        return $this->posts->toArray();
    }

    /**
     * @inheritdoc
     * @return string[] The user roles
     */
    public function getRoles() : array
    {
        if ($this->isAdmin()) {
            return ['ROLE_ADMIN'];
        }

        return [];
    }

    /**
     * @inheritdoc
     * @return string|null The salt
     */
    public function getSalt() : string
    {
        return '';
    }

    /**
     * @inheritdoc
     * @return string The username
     */
    public function getUsername() : string
    {
        return $this->username;
    }

    /**
     * @inheritdoc
     */
    public function eraseCredentials() : User
    {
        return $this;
    }

    /**
     * @return bool
     */
    public function isAdmin(): bool
    {
        return $this->admin;
    }
}
