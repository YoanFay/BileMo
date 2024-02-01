<?php

namespace App\EventSubscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\Exception\HttpException;

class ExceptionSubscriber implements EventSubscriberInterface
{


    /**
     * @return string[]
     */
    public static function getSubscribedEvents(): array
    {

        return ['kernel.exception' => 'onKernelException'];

    }


    /**
     * @param ExceptionEvent $event parameter
     *
     * @return void
     */
    public function onKernelException(ExceptionEvent $event): void
    {

        /*$exception = $event->getThrowable();
        $data = [
            'status' => 500,
            'message' => $exception->getMessage()
        ];

        if ($exception instanceof HttpException) {
            $data = [
                'status' => $exception->getStatusCode(),
                'message' => $exception->getMessage()
            ];
        }

        $event->setResponse(new JsonResponse($data));*/

    }


}
