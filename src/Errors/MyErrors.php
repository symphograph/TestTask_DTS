<?php

namespace App\Errors;

use Exception;

class MyErrors extends Exception
{
    public function __construct(
        string $msg = "",
        private readonly string $pubMsg = '',
        protected int $httpStatus = 500
    )
    {
        /* Какая-то логика */
        parent::__construct($msg);
    }
}