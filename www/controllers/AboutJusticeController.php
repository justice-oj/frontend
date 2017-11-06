<?php

namespace www\controllers;

class AboutJusticeController extends BaseController {
    public function actionIndex() {
        $this->view->title = 'Justice PLUS - About Justice';
        return $this->render('index');
    }
}