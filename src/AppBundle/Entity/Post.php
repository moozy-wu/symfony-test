<?php

namespace AppBundle\Entity;

class Post
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $text;

    /**
     * @var User
     */
    private $author;

    /**
     * @var \DateTime
     */
    private $created_at;

    /**
     * Post constructor.
     * @param string $text
     * @param User $author
     */
    public function __construct(string $text, User $author)
    {
        $this->text = $text;
        $this->author = $author;
        $this->created_at = new \DateTime();
    }

    /**
     * @return int
     */
    public function getId() : int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getText() : string
    {
        return $this->text;
    }

    /**
     * @return User
     */
    public function getAuthor(): User
    {
        return $this->author;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedAt(): \DateTime
    {
        return $this->created_at;
    }
}