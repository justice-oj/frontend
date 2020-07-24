<?php

use common\components\queue\BasicRabbitMQProducer;

return [
    'components' => [
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=localhost;dbname=www_justice_plus',
            'username' => 'root',
            'password' => 'root',
            'charset' => 'utf8',
        ],
        'rabbitMQ' => [
            'class' => BasicRabbitMQProducer::class,
            'host' => '127.0.0.1',
            'port' => 5672,
            'user' => 'justice',
            'password' => 'justice',
            'queueName' => 'justice',
            'exchangeName' => 'justice',
            'exchangeType' => 'topic',
        ],
        'redis' => [
            'class' => 'yii\redis\Connection',
            'hostname' => '127.0.0.1',
            'port' => 6379,
            'database' => 15,
        ],
        'session' => [
            'class' => 'yii\redis\Session',
            'redis' => [
                'hostname' => '127.0.0.1',
                'port' => 6379,
                'database' => 14,
            ]
        ],
    ],
];
