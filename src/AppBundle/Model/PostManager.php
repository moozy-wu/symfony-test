<?php

namespace AppBundle\Model;

use AppBundle\Entity\Post;
use AppBundle\Model\Command\CreatePostCommand;
use AppBundle\Model\Command\DeletePostCommand;
use AppBundle\Repository\PostRepositoryInterface;

class PostManager implements PostManagerInterface
{
    /**
     * @var PostRepositoryInterface
     */
    private $post_repository;

    /**
     * PostManager constructor.
     * @param PostRepositoryInterface $post_repository
     */
    public function __construct(PostRepositoryInterface $post_repository)
    {
        $this->post_repository = $post_repository;
    }
    
    /**
     * @param CreatePostCommand $command
     * @return Post
     */
    public function createPost(CreatePostCommand $command): Post
    {
        $post = new Post($command->getText(), $command->getUser());
        $this->post_repository->save($post);

        return $post;
    }

    /**
     * @param int $limit
     * @param int $offset
     * @return Post[]
     */
    public function getPosts(int $limit = null, int $offset = null): array
    {
        return $this->post_repository->findBy([], ['created_at' => 'desc'], $limit, $offset);
    }

    /**
     * @param DeletePostCommand $command
     * @return Post
     */
    public function deletePost(DeletePostCommand $command): Post
    {
        $post = $this->post_repository->getById($command->getPostId());
        return $this->post_repository->remove($post);
    }
}
