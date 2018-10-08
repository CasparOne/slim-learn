<?php
return [
    'settings' => [
        'logger' => [
            'logfile' => __DIR__ . '/../var/logs/log.txt',
            'name' => 'db_logger',
            'handlers' => [
                new Monolog\Handler\StreamHandler(__DIR__ . '/../var/logs/log.txt'),
            ]
        ],
        'eloquent' => [
            'driver' => 'mysql',
            'host' => 'localhost',
            'database' => 'test',
            'username' => 'root',
            'password' => '',
            'charset'   => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix'    => '',
        ],
    ]
];