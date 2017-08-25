<?php

namespace AppBundle\Model\Command;

class DeletePostCommand
{
    /**
     * @var int
     */
    private $post_id;

    /**
     * DeletePostCommand constructor.
     */
    public function __construct()
    {
        $this->post_id = 0;
    }

    /**
     * @return int
     */
    public function getPostId(): int
    {
        return $this->post_id;
    }

    /**
     * @param int $post_id
     */
    public function setPostId(int $post_id)
    {
        $this->post_id = $post_id;
    }
}