<?php

namespace App\EventListener;

use App\Exception\ErrorException;
use Symfony\Component\EventDispatcher\Attribute\AsEventListener;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\KernelInterface;
use Symfony\Component\Validator\Exception\ValidationFailedException;

#[AsEventListener(event: 'kernel.exception')]
class ExceptionListener
{
    public function __construct(private KernelInterface $kernel) {}
    public function __invoke(ExceptionEvent $event): void
    {
        $exception = $event->getThrowable();

        dd($exception);
        $response = new JsonResponse();

        if ($exception instanceof ValidationFailedException || $exception->getPrevious() instanceof ValidationFailedException) {
            $validationFailedException = ($exception instanceof ValidationFailedException)
                ? $exception
                : $exception->getPrevious();

            $errors = [];
            foreach ($validationFailedException->getViolations() as $violation) {
                $errors[] = [
                    'path' => $violation->getPropertyPath(),
                    'error' => $violation->getMessage(),
                ];
            }

            $response->setData(["error" => $errors]);
            $response->setStatusCode(Response::HTTP_UNPROCESSABLE_ENTITY);
        } else if ($exception instanceof ErrorException || $exception->getPrevious() instanceof ErrorException) {
            $errorException = ($exception instanceof ErrorException) ? $exception : $exception->getPrevious();
            $response->setData($errorException->getError());
            $response->setStatusCode($errorException->getCode());
        } else {
            $error = $this->kernel->getEnvironment() === 'prod' ? 'An error occurred' : ($exception->getMessage() ?: $exception->getTrace());
            $response->setData(["error" => [["path" => "Server", "error" => $error]]]);
            $response->setStatusCode(Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        $event->setResponse($response);
    }
}
