<?php
namespace APIBundle\EventListener;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Event\GetResponseForControllerResultEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class ViewResponseListener implements EventSubscriberInterface
{
    public function onKernelView(GetResponseForControllerResultEvent $event)
    {
        $path = $event->getRequest()->getPathInfo();
        if (strpos($path, '/api') !== 0) {
            return ;
        }

        $data = $event->getControllerResult();
        if (is_array($data)) {
            $response = new JsonResponse($data);
            $event->setResponse($response);
        }

    }

    public static function getSubscribedEvents()
    {
        // Must be executed before SensioFrameworkExtraBundle's listener
        return array(
            KernelEvents::VIEW => array('onKernelView', 30),
        );
    }

}