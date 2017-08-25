<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{
    /**
     * @param string $username
     * @return Response
     */
    public function detailAction(string $username = ''): Response
    {
        $user_manager = $this->get('user.manager');
        $user = $user_manager->findUser($username);

        return $this->render('user/detail.html.twig', [
            'user' => $user
        ]);
    }
}