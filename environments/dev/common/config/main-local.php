<?php
/** @noinspection SpellCheckingInspection */
return [
    'components' => [
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=justice.mysql;dbname=www_justice_plus',
            'username' => 'root',
            'password' => 'xaiTIVP7kB$oHuJecEooq#YsziVvVAzW',
            'charset' => 'utf8',
        ],
        'rabbitMQ' => [
            'class' => \common\components\queue\BasicRabbitMQProducer::class,
            'host' => 'justice.rabbitmq',
            'port' => 5672,
            'user' => 'justice',
            'password' => 'justice',
            'queueName' => 'justice',
            'exchangeName' => 'justice',
            'exchangeType' => 'topic',
        ],
        'redis' => [
            'class' => 'yii\redis\Connection',
            'hostname' => 'justice.redis',
            'port' => 6379,
            'database' => 15,
        ],
        'session' => [
            'class' => 'yii\redis\Session',
            'redis' => [
                'hostname' => 'justice.redis',
                'port' => 6379,
                'database' => 14,
            ]
        ],
    ],
];
