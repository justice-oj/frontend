<?php
return yii\helpers\ArrayHelper::merge(
    require(__DIR__ . '/main.php'),
    require(__DIR__ . '/main-local.php'),
    require(__DIR__ . '/test.php'),
    [
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
                'database' => 5,
            ],
            'session' => [
                'class' => 'yii\redis\Session',
                'redis' => [
                    'hostname' => '192.168.216.128',
                    'port' => 6379,
                    'database' => 4,
                ]
            ],
        ],
    ]
);
