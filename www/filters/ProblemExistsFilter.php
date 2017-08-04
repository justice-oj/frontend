<?php

namespace www\filters;

use common\models\Problem;
use Yii;
use yii\base\ActionFilter;

class ProblemExistsFilter extends ActionFilter {
    public function beforeAction($action) {
        $problem_id = intval(Yii::$app->request->get('problem_id'));
        if (empty($problem_id)) {
            Yii::$app->response->redirect([
                'error/index',
                'message' => 'Parameter <$problem_id> required.'
            ]);
            return false;
        }


        $problem = Problem::findOne($problem_id);
        if (empty($problem)) {
            Yii::$app->response->redirect([
                'error/index',
                'message' => 'This problem does not exist.'
            ]);
            return false;
        }

        return parent::beforeAction($action);
    }
}