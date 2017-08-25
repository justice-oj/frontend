<?php

namespace www\modules\problem\controllers;

use admin\controllers\BaseController;
use common\services\ProblemService;
use Kilte\Pagination\Pagination;
use www\filters\ProblemExistsFilter;
use www\filters\UserLoggedinFilter;
use Yii;
use yii\helpers\Html;

class SubmissionsController extends BaseController {
    protected $problemService;


    public function __construct(
        $id,
        $module,
        ProblemService $problemService,
        $config = []
    ) {
        $this->problemService = $problemService;
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
        $query = $this->problemService->getSubmissionsByProblemID($problem_id);
        $pagination = new Pagination(
            $query->count(),
            intval(Yii::$app->request->get('page', 1)),
            Yii::$app->params['paginationPerPage']
        );

        $this->view->title = 'Justice PLUS - Submissions of ' . Html::encode($problem->title);
        return $this->render('index', [
            'problem' => $problem,
            'pagination' => $pagination->build(),
            'records' => $query->offset($pagination->offset())->limit($pagination->limit())->all(),
        ]);
    }
}