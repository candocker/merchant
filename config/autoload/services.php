<?php

declare(strict_types=1);

$registry = [
    'protocol' => 'consul',
    'address' => 'http://172.22.0.2:8500',
];
return [
    'consumers' => [
        [
            'name' => 'PassportRpcServer',
            'registry' => $registry,
        ],
    ],
];
