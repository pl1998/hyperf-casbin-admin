<?php

declare(strict_types=1);
/**
 * This file is part of Hyperf.
 *
 * @link     https://www.hyperf.io
 * @document https://hyperf.wiki
 * @contact  group@hyperf.io
 * @license  https://github.com/hyperf/hyperf/blob/master/LICENSE
 */
$formatter = [
    'class' => Monolog\Formatter\LineFormatter::class,
    'constructor' => [
        'format' => null,
        'dateFormat' => 'Y-m-d H:i:s',
        'allowInlineLineBreaks' => true,
    ],
];

return [
    'default' => [
        'handler' => [
            'class' => Monolog\Handler\StreamHandler::class,
            'constructor' => [
                'stream' => BASE_PATH . '/runtime/logs/hyperf.log',
                'level' => Monolog\Logger::DEBUG,
            ],
        ],
        'formatter' => $formatter,
    ],
    // 记录login日志
    'login' => [
        'handler' => [
            'class' => Monolog\Handler\RotatingFileHandler::class,
            'constructor' => [
                'filename' => BASE_PATH . '/runtime/logs/login/log.log',
                'level' => Monolog\Logger::DEBUG,
            ],
        ],
        'formatter' => $formatter,
    ],
    // 记录login日志
    'sql' => [
        'handler' => [
            'class' => Monolog\Handler\RotatingFileHandler::class,
            'constructor' => [
                'filename' => BASE_PATH . '/runtime/logs/sql/log.log',
                'level' => Monolog\Logger::DEBUG,
            ],
        ],
        'formatter' => $formatter,
    ],
];
