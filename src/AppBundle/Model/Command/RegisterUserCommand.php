<?php

namespace AppBundle\Model\Command;

class RegisterUserCommand
{
    /**
     * @var string
     */
    private $username;

    /**
     * @var string
     */
    private $password;

    /**
     * @var string
     */
    private $password2;

    /**
     * RegisterUserCommand constructor.
     */
    public function __construct()
    {
        $this->username = '';
        $this->password = '';
        $this->password2 = '';
    }

    /**
     * @return string
     */
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @return string
     */
    public function getPassword2() : string
    {
        return $this->password2;
    }

    /**
     * @param string $username
     */
    public function setUsername(string $username)
    {
        $this->username = $username;
    }

    /**
     * @param string $password
     */
    public function setPassword(string $password)
    {
        $this->password = $password;
    }

    /**
     * @param string $password2
     */
    public function setPassword2(string $password2)
    {
        $this->password2 = $password2;
    }
}
