<?php
/** @noinspection SpellCheckingInspection */

use common\components\queue\BasicRabbitMQProducer;

return [
    'components' => [
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=localhost;dbname=www_justice_plus',
            'username' => 'root',
            'password' => 'root',
            'charset' => 'utf8mb4',
            'attributes' => [PDO::ATTR_CASE => PDO::CASE_LOWER], // https://github.com/yiisoft/yii2/issues/18171
        ],
        'rabbitMQ' => [
            'class' => BasicRabbitMQProducer::class,
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
