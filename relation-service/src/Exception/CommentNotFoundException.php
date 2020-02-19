<?php

namespace App\Exception;

use Throwable;

class CommentNotFoundException extends \Exception
{
    public function __construct($message = 'Comment not found', $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
