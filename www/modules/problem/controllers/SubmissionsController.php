<?php

namespace www\modules\problem\controllers;

use admin\controllers\BaseController;
use common\services\ProblemService;
use common\services\SubmissionService;
use Kilte\Pagination\Pagination;
use www\filters\ProblemExistsFilter;
use www\filters\UserLoggedInFilter;
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
            ['class' => UserLoggedInFilter::className()],
            ['class' => ProblemExistsFilter::className()]
        ];
    }


    public function actionIndex(int $problem_id) {
        $problem = $this->problemService->getProblemByID($problem_id);
        $page = intval(Yii::$app->request->get('page', 1));
        $this->view->title = 'Justice PLUS - Submissions of ' . Html::encode($problem->title);

        return $this->render('index', [
            'problem' => $problem,
            'pagination' => (new Pagination(
                $this->submissionService->getTotalSubmissionsCountByProblemID($problem_id),
                $page,
                intval(Yii::$app->params['paginationPerPage'])
            ))->build(),
            'records' => $this->submissionService->getSubmissionsListByProblemID($problem_id, $page),
        ]);
    }
}