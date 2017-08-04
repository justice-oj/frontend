<?php

namespace www\controllers;

class ErrorController extends BaseController {
    public function actionIndex(string $message = null) {
        $this->view->title = 'Justice PLUS - Error';
        return $this->render('index', [
            'message' => empty($message) ? 'An error occurs.' : $message
        ]);
    }
}
