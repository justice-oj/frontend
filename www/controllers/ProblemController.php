<?php

namespace www\controllers;

use common\services\EditorialService;
use common\services\ProblemService;
use Kilte\Pagination\Pagination;
use www\filters\ProblemExistsFilter;
use www\filters\UserLoggedinFilter;
use Yii;
use yii\helpers\Html;
use yii\web\Response;

class ProblemController extends BaseController {
    protected $problemService;
    protected $editorialService;


    public function __construct(
        $id,
        $module,
        ProblemService $problemService,
        EditorialService $editorialService,
        $config = []
    ) {
        $this->problemService = $problemService;
        $this->editorialService = $editorialService;
        parent::__construct($id, $module, $config);
    }


    public function behaviors() {
        return [
            ['class' => UserLoggedinFilter::className()],
            ['class' => ProblemExistsFilter::className(), 'only' => ['index', 'submissions', 'discussions', 'editorial']]
        ];
    }


    public function actionIndex(int $problem_id) {
        $problem = $this->problemService->getProblemByID($problem_id);
        $this->view->title = 'Justice PLUS - ' . Html::encode($problem->title);

        return $this->render('index', [
            'problem' => $problem,
        ]);
    }


    public function actionSubmissions(int $problem_id) {
        $problem = $this->problemService->getProblemByID($problem_id);
        $query = $this->problemService->getSubmissionsByProblemID($problem_id);
        $pagination = new Pagination(
            $query->count(),
            intval(Yii::$app->request->get('page', 1)),
            Yii::$app->params['paginationPerPage']
        );

        $this->view->title = 'Justice PLUS - Submissions of ' . Html::encode($problem->title);
        return $this->render('submissions', [
            'problem' => $problem,
            'pagination' => $pagination->build(),
            'records' => $query->offset($pagination->offset())->limit($pagination->limit())->all(),
        ]);
    }


    public function actionDiscussions(int $problem_id) {
        $problem = $this->problemService->getProblemByID($problem_id);
        $this->view->title = 'Justice PLUS - Discussions of ' . Html::encode($problem->title);

        return $this->render('discussions', [
            'problem' => $problem,
        ]);
    }


    public function actionEditorial(int $problem_id) {
        $problem = $this->problemService->getProblemByID($problem_id);
        $editorial = $this->editorialService->getEditorialByProblemID($problem_id);
        $this->view->title = 'Justice PLUS - Editorial of ' . Html::encode($problem->title);

        return $this->render('editorial', [
            'problem' => $problem,
            'editorial' => $editorial,
        ]);
    }


    public function actionSubmit() {
        Yii::$app->response->format = Response::FORMAT_JSON;

        $problem_id = intval(Yii::$app->request->post('problem_id'));
        $language = Yii::$app->request->post('language');
        $code = Yii::$app->request->post('code');

        if (empty($problem_id) || strlen($language) === 0) {
            return [
                'code' => 1,
                'message' => 'Parameter missing.'
            ];
        }

        $submission_id = $this->problemService->submit($problem_id, $language, $code);
        return [
            'code' => 0,
            'message' => 'OK',
            'data' => [
                'submission_id' => $submission_id
            ]
        ];
    }
}