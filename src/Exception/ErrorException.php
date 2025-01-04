<?php

declare(strict_types=1);

namespace App\Exception;

class ErrorException extends \RuntimeException
{
    public function __construct(private string $path = '', string $message = '', int $code = 400)
    {
        parent::__construct($message, $code);
    }

    public function getError(): array
    {
        return [
            'error' => [
                [
                    'path' => $this->path,
                    'error' => $this->message,
                ]
            ]
        ];
    }
}
