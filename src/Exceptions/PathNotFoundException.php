<?php

namespace Somnium\Exceptions;

use Exception;
use Throwable;

class PathNotFoundException extends Exception
{
    /**
     * Creates a new class instance
     */
    public function __construct(
        string $path,
        string $description = 'path',
        Throwable $previous = null
    ) {
        parent::__construct(
            message: ucfirst($description) . " [$path] does not exist!",
            previous: $previous
        );
    }
}
