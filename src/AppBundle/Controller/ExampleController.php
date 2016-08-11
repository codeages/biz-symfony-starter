<?php
namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;

class ExampleController extends BaseController
{
    public function homepageAction(Request $request)
    {
        return $this->render('AppBundle:Example:index.html.twig');
    }

    public function registerAction(Request $request)
    {
        if ('POST' == $request->getMethod()) {
            $user = $request->request->all();
            $user = $this->getUserService()->register($user);
            $this->login($user, $request);
            return $this->redirect($this->generateUrl('homepage'));
        }

        return $this->render('AppBundle:Example:register.html.twig');
    }

    public function loginAction(Request $request)
    {
        $authenticationUtils = $this->get('security.authentication_utils');

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();

        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render(
            'AppBundle:Example:login.html.twig',
            array(
                'last_username' => $lastUsername,
                'error'         => $error,
            )
        );

    }

    public function logoutAction(Request $request)
    {
    }

    public function checkAction(Request $request)
    {
    }

    protected function getUserService()
    {
        return $this->biz['user_service'];
    }
}
