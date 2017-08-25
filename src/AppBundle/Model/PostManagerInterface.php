<?php

namespace AppBundle\Model;

use AppBundle\Entity\Post;
use AppBundle\Model\Command\CreatePostCommand;
use AppBundle\Model\Command\DeletePostCommand;

interface PostManagerInterface
{
    /**
     * @param CreatePostCommand $command
     * @return Post
     */
    public function createPost(CreatePostCommand $command): Post;

    /**
     * @param int $limit
     * @param int $offset
     * @return Post[]
     */
    public function getPosts(int $limit = null, int $offset = null): array;

    /**
     * @param DeletePostCommand $command
     * @return Post
     */
    public function deletePost(DeletePostCommand $command): Post;
}