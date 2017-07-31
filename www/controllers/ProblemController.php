<?php

namespace www\controllers;

use common\services\ProblemService;
use Kilte\Pagination\Pagination;
use www\filters\UserLoggedinFilter;
use Yii;

class ProblemController extends BaseController {
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
        ];
    }


    public function actionIndex(int $id) {
        $this->view->title = 'Justice PLUS - Problem';

        $problem = $this->problemService->getProblemByID($id);

        return $this->render('index', [
            'problem' => $problem,
        ]);
    }


    public function actionSubmissions(int $problem_id) {
        $this->view->title = 'Justice PLUS - Submissions';

        $problem = $this->problemService->getProblemByID($problem_id);
        $query = $this->problemService->findSubmissionsByProblemID($problem_id);
        $pagination = new Pagination(
            $query->count(),
            intval(Yii::$app->request->get('page', 1)),
            Yii::$app->params['paginationPerPage']
        );

        return $this->render('submissions', [
            'problem' => $problem,
            'pagination' => $pagination->build(),
            'records' => $query->offset($pagination->offset())->limit($pagination->limit())->all(),
        ]);
    }


    public function actionDiscussions(int $problem_id) {
        $this->view->title = 'Justice PLUS - Discussions';

        $problem = $this->problemService->getProblemByID($problem_id);

        return $this->render('index', [
            'problem' => $problem,
        ]);
    }


    public function actionEditorial(int $problem_id) {
        $this->view->title = 'Justice PLUS - Editorial';

        $problem = $this->problemService->getProblemByID($problem_id);

        return $this->render('index', [
            'problem' => $problem,
        ]);
    }
}
