<?php

namespace www\controllers;

use yii\helpers\Html;

class ErrorController extends BaseController {
    public function actionIndex(string $message = null) {
        $this->view->title = 'Justice PLUS - Error';
        return $this->render('index', [
            'message' => empty($message) ? 'An error occurs.' : Html::encode($message)
        ]);
    }
}