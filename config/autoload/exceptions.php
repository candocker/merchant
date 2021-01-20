<?php

declare(strict_types = 1);

return [
    'handler' => [
        'http' => [
            Swoolecan\Baseapp\Exceptions\Handler\ExceptionHandler::class,
        ],
    ],
];
