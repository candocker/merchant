<?php
return [
    'apps' => [
        'passport' => '基础应用',
        'merchant' => '商家系统',
        'third' => '第三方平台',
    ],
    'attachment' => [
        'business' => [
            'common' => '通用',
            'pet' => '宠物',
            'culture' => '文化',
        ],
        'system' => [
            'oss' => ['name' => '唐目OSS', 'host' => env('OSS_HOST', '')],
            'oss_free' => ['name' => '自有OSS', 'host' => env('OSS_FREE_HOST', '')],
            'local_old' => ['name' => '本地系统（old)', 'host' => env('FILESYS_LOCAL_OLD_HOST', '')],
            'local' => ['name' => '本地系统', 'host' => env('FILESYS_LOCAL_HOST', '')],
        ],
    ],
];
