<?php
namespace APIBundle\EventListener;

use APIBundle\ErrorCode;
use Codeages\Biz\Framework\Service\Exception\InvalidArgumentException;
use Codeages\Biz\Framework\Service\Exception\NotFoundException;
use Codeages\Biz\Framework\Service\Exception\ServiceException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Codeages\Biz\Framework\Service\Exception\AccessDeniedException;

class ExceptionListener implements EventSubscriberInterface
{
    public function onKernelException(GetResponseForExceptionEvent $event)
    {
        $path = $event->getRequest()->getPathInfo();
        if (strpos($path, '/api') !== 0) {
            return ;
        }

        $response = new JsonResponse();
        $error = array();

        $e = $event->getException();
        if ($e instanceof HttpExceptionInterface) {
            $response->setStatusCode($e->getStatusCode());
        }

        if ($e instanceof NotFoundHttpException || $e instanceof NotFoundException) {
            $response->setStatusCode(404);
            $error['code'] = ErrorCode::NOT_FOUND;
            $error['message'] = $e->getMessage();
        } elseif ($e instanceof AccessDeniedHttpException || $e instanceof AccessDeniedException) {
            $response->setStatusCode(403);
            $error['code'] = ErrorCode::ACCESS_DENIED;
            $error['message'] = $e->getMessage();
        } elseif ($e instanceof InvalidArgumentException) {
            $response->setStatusCode(422);
            $error['code'] = ErrorCode::INVALID_ARGUMENT;
            $error['message'] = '参数不正确';
        } elseif ($e instanceof HttpExceptionInterface) {
            $response->setStatusCode($e->getStatusCode());
            $error['code'] = ErrorCode::BAD_REQUEST;
            $error['message'] = $e->getMessage();
        } elseif ($e instanceof ServiceException && $e->getCode() > 0) {
            $response->setStatusCode(400);
            $error['code'] = $e->getCode();
            $error['message'] = $e->getMessage();
        } else {
            $response->setStatusCode(500);
            $error['code'] = ErrorCode::INTERNAL_SERVER_ERROR;
            $error['message'] = '服务器内部错误';
        }

        $response->setData(array(
            'error' => $error,
        ));

        $event->setResponse($response);
    }

    public static function getSubscribedEvents()
    {
        return array(
            KernelEvents::EXCEPTION => array('onKernelException', 255),
        );
    }

}