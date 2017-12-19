<?php

namespace admin\modules\problem\controllers;

use admin\controllers\BaseController;
use admin\filters\AdminLoggedInFilter;
use common\services\ProblemService;
use Kilte\Pagination\Pagination;
use Yii;
use yii\helpers\Html;
use yii\web\Response;

class ManageController extends BaseController {
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
            ['class' => AdminLoggedInFilter::className()],
        ];
    }


    public function actionIndex(string $id = null, string $title = null) {
        $this->view->title = 'Justice PLUS Admin - Problems';

        $query = $this->problemService->searchProblems($id, $title)->orderBy(['id' => SORT_DESC]);
        $pagination = new Pagination(
            $query->count(),
            intval(Yii::$app->request->get('page', 1)),
            Yii::$app->params['paginationPerPage']
        );

        return $this->render('index', [
            'id' => Html::encode($id),
            'title' => Html::encode($title),
            'pagination' => $pagination->build(),
            'records' => $query->offset($pagination->offset())->limit($pagination->limit())->all(),
        ]);
    }


    public function actionNew() {
        $this->view->title = 'Justice PLUS Admin - Add Problem';
        return $this->render('new');
    }


    public function actionAdd() {
        Yii::$app->response->format = Response::FORMAT_JSON;

        $title = Yii::$app->request->post('title');
        $description = Yii::$app->request->post('description');
        $level = intval(Yii::$app->request->post('level'));
        $runtime_limit = intval(Yii::$app->request->post('runtime_limit'));
        $memory_limit = intval(Yii::$app->request->post('memory_limit'));

        if (empty($title) || empty($description) || empty($level) || empty($runtime_limit) || empty($memory_limit)) {
            return [
                'code' => 1,
                'message' => 'missing argument(s)'
            ];
        }

        try {
            $this->problemService->addProblem($title, $description, $level, $runtime_limit, $memory_limit);
            return [
                'code' => 0,
                'message' => 'OK'
            ];
        } catch (\Exception $e) {
            return [
                'code' => 2,
                'message' => 'an error occurred while adding problem'
            ];
        }
    }


    public function actionEdit(int $problem_id) {
        $this->view->title = 'Justice PLUS Admin - Edit Problem';

        $problem = $this->problemService->getProblemByID($problem_id);

        return $this->render('edit', [
            'problem' => $problem,
        ]);
    }


    public function actionUpdate() {
        Yii::$app->response->format = Response::FORMAT_JSON;

        $problem_id = intval(Yii::$app->request->post('problem_id'));
        $title = Yii::$app->request->post('title');
        $description = Yii::$app->request->post('description');
        $level = Yii::$app->request->post('level');
        $runtime_limit = Yii::$app->request->post('runtime_limit');
        $memory_limit = Yii::$app->request->post('memory_limit');

        if (empty($problem_id)
            || empty($title)
            || empty($description)
            || empty($level)
            || empty($runtime_limit)
            || empty($memory_limit)
        ) {
            return [
                'code' => 1,
                'message' => 'missing argument(s)'
            ];
        }

        $problem = $this->problemService->getProblemByID($problem_id);
        if (is_null($problem)) {
            return [
                'code' => 2,
                'message' => 'problem not exists'
            ];
        }

        $pid = $this->problemService->updateProblem($problem, $title, $description, $level, $runtime_limit, $memory_limit);
        return [
            'code' => 0,
            'message' => 'OK',
            'data' => [
                'problem_id' => $pid
            ]
        ];
    }


    /**
     * @author  liuchao
     * @mail    i@liuchao.me
     * @return array
     * @throws \Exception
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function actionDelete() {
        Yii::$app->response->format = Response::FORMAT_JSON;

        $problem_id = intval(Yii::$app->request->post('problem_id'));
        if (empty($problem_id)) {
            return [
                'code' => 1,
                'message' => 'missing argument(s)'
            ];
        }

        $result = $this->problemService->deleteProblem($problem_id);
        if ($result === false) {
            return [
                'code' => 2,
                'message' => 'remove record failed'
            ];
        }

        return [
            'code' => 0,
            'message' => 'OK'
        ];
    }
}