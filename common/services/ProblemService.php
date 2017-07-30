<?php

namespace common\services;

use common\models\Problem;
use Yii;

class ProblemService  {
    protected $problem = null;


    public function __construct(Problem $problem) {
        $this->problem = $problem;
    }


    /**
     * @author  liuchao
     * @mail    i@liuchao.me
     * @param   int $id
     * @return  Problem
     * @desc
     */
    public function getProblemByID(int $id) {
        return $this->problem->findOne($id);
    }

    /**
     * @author  liuchao
     * @mail    i@liuchao.me
     * @param   string $code
     * @param   string $title
     * @return  yii\db\ActiveQuery
     * @desc
     */
    public function getProblemsWithStatus(?string $code, ?string $title) {
        $id = Yii::$app->session->get(Yii::$app->params['userIdKey']);
        return $this->problem->find()
            ->select([
                't_problem.id               AS id',
                't_problem.title            AS title',
                't_problem.submission_count AS total',
                't_problem.accepted_count   AS accepted',
                't_problem.level            AS level',
                't_user_problem.status      AS status'
            ])
            ->leftJoin('t_user_problem', "t_problem.id = t_user_problem.problem_id AND t_user_problem.user_id = $id")
            ->andFilterWhere(['t_problem.id' => $code])
            ->andFilterWhere(['LIKE', 't_problem.title', $title]);
    }
}