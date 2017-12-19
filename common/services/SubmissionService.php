<?php

namespace common\services;

use common\models\Submission;
use Yii;

/**
 * Class SubmissionService
 * @package common\services
 */
class SubmissionService {
    /**
     * @author  liuchao
     * @mail    i@liuchao.me
     * @param int $id
     * @return \common\models\Submission|null
     * @desc
     */
    public function getSubmissionByID(int $id) {
        return Submission::findOne($id);
    }


    /**
     * @author  liuchao
     * @mail    i@liuchao.me
     * @param  int $user_id
     * @return \yii\db\ActiveQuery
     * @desc
     */
    public function getSubmissionsByUserID(int $user_id) {
        return Submission::find()->where(['user_id' => $user_id]);
    }


    /**
     * @author  liuchao
     * @mail    i@liuchao.me
     * @return int
     * @desc
     */
    public function getTotalSubmissionsCount() {
        return intval(Submission::find()->count());
    }


    /**
     * @author  liuchao
     * @mail    i@liuchao.me
     * @param   $problem_id
     * @desc
     * @return int
     */
    public function getTotalSubmissionsCountByProblemID($problem_id) {
        return intval(Submission::find()->where(['problem_id' => $problem_id])->count());
    }


    /**
     * @author  liuchao
     * @mail    i@liuchao.me
     * @param   int $page
     * @return  array
     * @desc    get submissions on page $page
     * @throws \yii\db\Exception
     */
    public function getSubmissionsList(int $page) {
        $limit = intval(Yii::$app->params['paginationPerPage']);
        $offset = $limit * ($page - 1);

        $sql = <<<SQL
SELECT
  s.id         AS id,
  u.country    AS country,
  u.username   AS username,
  s.problem_id AS problem_id,
  p.title      AS problem_title,
  s.language   AS language,
  s.status     AS status,
  s.runtime    AS runtime,
  s.memory     AS memory,
  s.created_at AS created_at
FROM t_submission s
  JOIN (SELECT id FROM t_submission ORDER BY id DESC LIMIT $offset, $limit) t ON s.id = t.id
  LEFT JOIN t_problem p ON s.problem_id = p.id
  LEFT JOIN t_user u ON s.user_id = u.id
ORDER BY s.id DESC;
SQL;

        return Yii::$app->db->createCommand($sql)->queryAll();
    }


    /**
     * @author  liuchao
     * @mail    i@liuchao.me
     * @param   int $problem_id
     * @param   int $page
     * @return  array
     * @desc    get submissions of $problem_id on page $page
     * @throws \yii\db\Exception
     */
    public function getSubmissionsListByProblemID(int $problem_id, int $page) {
        $limit = intval(Yii::$app->params['paginationPerPage']);
        $offset = $limit * ($page - 1);

        $sql = <<<SQL
SELECT
  s.id         AS id,
  u.country    AS country,
  u.username   AS username,
  s.language   AS language,
  s.status     AS status,
  s.runtime    AS runtime,
  s.memory     AS memory,
  s.created_at AS created_at
FROM t_submission s
  JOIN (SELECT id FROM t_submission ORDER BY id DESC LIMIT $offset, $limit) t ON s.id = t.id
  LEFT JOIN t_problem p ON s.problem_id = p.id
  LEFT JOIN t_user u ON s.user_id = u.id
WHERE s.problem_id = $problem_id
ORDER BY s.id DESC;
SQL;

        return Yii::$app->db->createCommand($sql)->queryAll();
    }
}