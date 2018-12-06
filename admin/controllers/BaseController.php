<?php

namespace admin\controllers;

use Raven_Client;
use Raven_ErrorHandler;
use Yii;
use yii\web\Controller;

class BaseController extends Controller
{
    public function init()
    {
        parent::init();

        $client = new Raven_Client(Yii::$app->params['sentryDSN']);
        $error_handler = new Raven_ErrorHandler($client);
        $error_handler->registerExceptionHandler();
        $error_handler->registerErrorHandler();
        $error_handler->registerShutdownFunction();

        Yii::$app->session->open();
        Yii::$app->session->setTimeout(86400 * 30);
    }
}