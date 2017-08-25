<?php

namespace AppBundle\Model\Command;

use AppBundle\Entity\User;

class CreatePostCommand
{
    /**
     * @var string
     */
    private $text;

    /**
     * @var User
     */
    private $user;

    /**
     * CreatePostCommand constructor.
     */
    public function __construct()
    {
        $this->text = '';
    }

    /**
     * @return string
     */
    public function getText(): string
    {
        return $this->text;
    }

    /**
     * @return User
     */
    public function getUser(): User
    {
        return $this->user;
    }

    /**
     * @param string $text
     * @return CreatePostCommand
     */
    public function setText(string $text) : CreatePostCommand
    {
        $this->text = $text;
        return $this;
    }

    /**
     * @param User $user
     * @return CreatePostCommand
     */
    public function setUser(User $user) : CreatePostCommand
    {
        $this->user = $user;
        return $this;
    }
}