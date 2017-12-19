<?php
/** @noinspection SpellCheckingInspection */
return [
    'components' => [
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=192.168.216.128;dbname=www_justice_plus',
            'username' => 'root',
            'password' => 'xaiTIVP7kB$oHuJecEooq#YsziVvVAzW',
            'charset' => 'utf8',
        ],
        'rabbitMQ' => [
            'class' => \common\components\queue\BasicRabbitMQProducer::class,
            'host' => '192.168.216.128',
            'port' => 5672,
            'user' => 'justice',
            'password' => 'justice',
            'queueName' => 'justice',
            'exchangeName' => 'justice',
            'exchangeType' => 'topic',
        ],
        'redis' => [
            'class' => 'yii\redis\Connection',
            'hostname' => '192.168.216.128',
            'port' => 6379,
            'database' => 15,
        ],
        'session' => [
            'class' => 'yii\redis\Session',
            'redis' => [
                'hostname' => '192.168.216.128',
                'port' => 6379,
                'database' => 14,
            ]
        ],
    ],
];
