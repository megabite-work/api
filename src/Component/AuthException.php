<?php

declare(strict_types=1);

namespace App\Component;

use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;

class AuthException extends UnauthorizedHttpException
{
    public function __construct($message = '')
    {
        parent::__construct($message, $message);
    }
}
