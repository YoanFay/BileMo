<?php

namespace App\EventSubscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\Exception\HttpException;

class ExceptionSubscriber implements EventSubscriberInterface
{
    public function onKernelException(ExceptionEvent $event): void
    {
    }

    public static function getSubscribedEvents(): array
    {
        return [
            'kernel.exception' => 'onKernelException',
        ];
    }
}
