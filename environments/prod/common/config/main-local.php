<?php
return [
    'components' => [
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=127.0.0.1;dbname=www_justice_plus',
            'username' => 'root',
            'password' => '',
            'charset' => 'utf8',
        ],
        'redis' => [
            'class' => 'yii\redis\Connection',
            'hostname' => '127.0.0.1',
            'port' => 6379,
            'database' => 15,
        ],
        'rabbitMQ' => [
            'class' => \yii\queue\amqp\Queue::class,
            'serializer' => \yii\queue\serializers\JsonSerializer::class,
            'host' => '127.0.0.1',
            'port' => 5672,
            'user' => 'justice',
            'password' => 'SQuHbc9FJTLqJqMUeTqdmsqORFPWVfWAHyrdJEaU',
            'queueName' => 'justice',
        ],
    ],
];
