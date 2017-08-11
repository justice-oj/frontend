<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'admin',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'defaultRoute' => 'index',
    'controllerNamespace' => 'admin\controllers',
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-admin',
        ],
        'session' => [
            'name' => 'admin',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'error',
        ],
        'assetManager' => [
            'forceCopy' => true,
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],
    ],
    'modules' => [
        'user' => [
            'class' => 'admin\modules\user\UserModule',
            'defaultRoute' => 'manage'
        ],
        'problem' => [
            'class' => 'admin\modules\problem\ProblemModule',
            'defaultRoute' => 'manage',
        ],
    ],
    'params' => $params,
];
