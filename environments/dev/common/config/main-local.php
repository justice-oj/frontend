<?php
return [
    'components' => [
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=192.168.216.128;dbname=www_justice_plus',
            'username' => 'root',
            'password' => 'xaiTIVP7kB$oHuJecEooq#YsziVvVAzW',
            'charset' => 'utf8',
        ],
        'redis' => [
            'class' => 'yii\redis\Connection',
            'hostname' => '192.168.216.128',
            'port' => 6379,
            'database' => 15,
        ],
        'rabbitMQ' => [
            'class' => \yii\queue\amqp\Queue::class,
            'serializer' => \yii\queue\serializers\JsonSerializer::class,
            'host' => '192.168.216.128',
            'port' => 5672,
            'user' => 'guest',
            'password' => 'guest',
            'queueName' => 'justice',
        ],
    ],
];
