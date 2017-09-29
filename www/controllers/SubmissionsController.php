<?php

namespace www\controllers;

use common\models\Submission;
use common\services\SubmissionService;
use common\services\UserService;
use Kilte\Pagination\Pagination;
use www\filters\UserLoggedinFilter;
use Yii;

class SubmissionsController extends BaseController {
    protected $submissionService;
    protected $userService;


    public function __construct(
        $id,
        $module,
        SubmissionService $submissionService,
        UserService $userService,
        $config = []
    ) {
        $this->submissionService = $submissionService;
        $this->userService = $userService;
        parent::__construct($id, $module, $config);
    }


    public function behaviors() {
        return [
            ['class' => UserLoggedinFilter::className()],
        ];
    }


    public function actionIndex() {
        $page = intval(Yii::$app->request->get('page', 1));
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

        $pagination = new Pagination(Submission::find()->select('id')->count(), $page, $limit);
        $this->view->title = 'Justice PLUS - Submissions';
        return $this->render('index', [
            'pagination' => $pagination->build(),
            'records' => Yii::$app->db->createCommand($sql)->queryAll(),
        ]);
    }
}
