<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Post;
use AppBundle\Form\CreatePostType;
use AppBundle\Form\DeletePostType;
use AppBundle\Model\Command\CreatePostCommand;
use AppBundle\Model\Command\DeletePostCommand;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

class DefaultController extends Controller
{
    /**
     * @return Form
     */
    private function createPostForm(): Form
    {
        return $this->createForm(CreatePostType::class, new CreatePostCommand());
    }

    /**
     * @param int $post_id
     * @return Form
     */
    private function deletePostForm(int $post_id): Form
    {
        $command = new DeletePostCommand();
        $command->setPostId($post_id);
        return $this->createForm(DeletePostType::class, $command);
    }

    /**
     * @return Response
     */
    public function indexAction(): Response
    {
        $post_manager = $this->get('post.manager');
        $post_form = $this->createPostForm();
        $posts = $post_manager->getPosts();

        $delete_forms = [];

        if ($this->isGranted('ROLE_ADMIN')) {
            foreach ($posts as $post) {
                $delete_forms[] = $this->deletePostForm($post->getId())->createView();
            }
        }

        return $this->render('default/index.html.twig', [
            'post_form' => $post_form->createView(),
            'posts' => $posts,
            'delete_forms' => $delete_forms
        ]);
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function createPostAction(Request $request): RedirectResponse
    {
        $post_form = $this->createPostForm()
            ->handleRequest($request);

        $post_manager = $this->get('post.manager');

        if ($post_form->isSubmitted() && $post_form->isValid()) {
            $command = $post_form->getData();
            $command->setUser($this->getUser());
            $post_manager->createPost($command);
        }

        return $this->redirectToRoute('homepage');
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function deletePostAction(Request $request): RedirectResponse
    {
        if (!$this->isGranted('ROLE_ADMIN')) {
            throw new AccessDeniedException();
        }

        $delete_form = $this->deletePostForm(0);
        $delete_form->handleRequest($request);

        $post_manager = $this->get('post.manager');

        if ($delete_form->isSubmitted() && $delete_form->isValid()) {
            $post_manager->deletePost($delete_form->getData());
        }

        return $this->redirectToRoute('homepage');
    }
}
