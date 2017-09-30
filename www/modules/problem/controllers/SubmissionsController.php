<?php

namespace www\modules\problem\controllers;

use admin\controllers\BaseController;
use common\services\ProblemService;
use common\services\SubmissionService;
use Kilte\Pagination\Pagination;
use www\filters\ProblemExistsFilter;
use www\filters\UserLoggedinFilter;
use Yii;
use yii\helpers\Html;

class SubmissionsController extends BaseController {
    protected $problemService;
    protected $submissionService;


    public function __construct(
        $id,
        $module,
        ProblemService $problemService,
        SubmissionService $submissionService,
        $config = []
    ) {
        $this->problemService = $problemService;
        $this->submissionService = $submissionService;
        parent::__construct($id, $module, $config);
    }


    public function behaviors() {
        return [
            ['class' => UserLoggedinFilter::className()],
            ['class' => ProblemExistsFilter::className()]
        ];
    }


    public function actionIndex(int $problem_id) {
        $problem = $this->problemService->getProblemByID($problem_id);

        $page = intval(Yii::$app->request->get('page', 1));
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

        $pagination = new Pagination($this->submissionService->getTotalSubmissionsCountByProblemID($problem_id), $page, $limit);
        $this->view->title = 'Justice PLUS - Submissions of ' . Html::encode($problem->title);
        return $this->render('index', [
            'problem' => $problem,
            'pagination' => $pagination->build(),
            'records' => Yii::$app->db->createCommand($sql)->queryAll(),
        ]);
    }
}