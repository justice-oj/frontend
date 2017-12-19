<?php

namespace www\filters;

use Yii;
use yii\base\ActionFilter;

class UserLoggedInFilter extends ActionFilter {
    public function beforeAction($action) {
        if (Yii::$app->session->get(Yii::$app->params['userLoggedInKey']) != 1) {
            $action->controller->redirect('/login');
            return false;
        }
        return parent::beforeAction($action);
    }
}