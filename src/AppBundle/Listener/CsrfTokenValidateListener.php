<?php
namespace AppBundle\Listener;

use Topxia\Service\Common\ServiceKernel;
use Symfony\Component\HttpKernel\HttpKernelInterface;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\Security\Csrf\CsrfToken;
use Symfony\Component\HttpFoundation\JsonResponse;

class CsrfTokenValidateListener
{
    public function __construct($container)
    {
        $this->container = $container;
    }

    public function onKernelRequest(GetResponseEvent $event)
    {

        $request = $event->getRequest();

        if ($event->getRequestType() != HttpKernelInterface::MASTER_REQUEST) {
            return ;
        }

        if (!in_array($request->getMethod(), ['POST', 'PUT', 'DELETE'])) {
            return ;
        }

        if ($request->isXmlHttpRequest()) {
            $token = $request->headers->get('X-CSRF-Token');
        } else {
            $name = $this->container->getParameter('app.csrf.token_form_name');
            $token = $request->request->get($name, '');
        }
        $request->request->remove('_csrf_token');

        if (!$this->isCsrfTokenValid($this->container->getParameter('app.csrf.token_id.default'), $token)) {
            $error = array (
                'code' => 5,
                'message' => '页面已过期，请重新提交数据!'
            );

            if ($request->isXmlHttpRequest()) {
                $response = new JsonResponse($error, 400);
            } else {
                $response = $this->container->get('templating')->renderResponse('error.html.twig', $error);
            }

            $event->setResponse($response);
        }

    }

    protected function isCsrfTokenValid($id, $token)
    {
        if (!$this->container->has('security.csrf.token_manager')) {
            throw new \LogicException('CSRF protection is not enabled in your application.');
        }

        return $this->container->get('security.csrf.token_manager')->isTokenValid(new CsrfToken($id, $token));
    }
}

