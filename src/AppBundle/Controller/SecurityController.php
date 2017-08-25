<?php

namespace AppBundle\Controller;

use AppBundle\Form\CreatePostType;
use AppBundle\Form\RegisterUserType;
use AppBundle\Model\Command\RegisterUserCommand;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends Controller
{
    /**
     * @return Form
     */
    private function createRegisterForm(): Form
    {
        return $this->createForm(RegisterUserType::class, new RegisterUserCommand());
    }

    /**
     * @param Request $request
     * @param AuthenticationUtils $authUtils
     * @return Response
     */
    public function loginAction(Request $request, AuthenticationUtils $authUtils): Response
    {
        $error = $authUtils->getLastAuthenticationError();
        $last_username = $authUtils->getLastUsername();
        $register_form = $this->createRegisterForm();
        return $this->render('security/login.html.twig', array(
            'last_username' => $last_username,
            'error'         => $error,
            'register_form' => $register_form->createView(),
        ));
    }

    /**
     *
     */
    public function logoutAction()
    {

    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function registerAction(Request $request): RedirectResponse
    {
        $register_form = $this->createRegisterForm();
        $register_form->handleRequest($request);

        if ($register_form->isSubmitted() && $register_form->isValid()) {
            $command = $register_form->getData();

            try {
                $this->get('user.manager')->registerUser($command);
            } catch (\Exception $ex) {
                $this->flash('error', 'Registrace se nezdařila');
            }
        }

        return $this->redirectToRoute('homepage');
    }
}
