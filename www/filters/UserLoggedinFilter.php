<?php

namespace www\filters;

use Yii;
use yii\base\ActionFilter;

class UserLoggedinFilter extends ActionFilter {
    public function beforeAction($action) {
        if (Yii::$app->session->get('logged_in') != 1) {
            return $action->controller->redirect('/login');
        }
        return parent::beforeAction($action);
    }
}