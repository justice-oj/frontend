<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'www',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'defaultRoute' => 'index/index',
    'controllerNamespace' => 'www\controllers',
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-www',
        ],
        'session' => [
            'name' => 'www',
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
        ],
    ],
    'modules' => [
        'problem' => [
            'class' => 'www\modules\problem\ProblemModule',
            'defaultRoute' => 'index',
        ],
    ],
    'params' => $params,
];
