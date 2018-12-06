<?php

namespace admin\modules\problem\controllers;

use admin\controllers\BaseController;
use admin\filters\AdminLoggedInFilter;
use common\services\ProblemService;
use common\services\TestCaseService;
use Kilte\Pagination\Pagination;
use Yii;
use yii\helpers\Html;
use yii\web\Response;

class TestCaseController extends BaseController
{
    protected $problemService;
    protected $testCaseService;


    public function __construct(
        $id,
        $module,
        ProblemService $problemService,
        TestCaseService $testCaseService,
        $config = []
    )
    {
        $this->problemService = $problemService;
        $this->testCaseService = $testCaseService;
        parent::__construct($id, $module, $config);
    }


    public function behaviors()
    {
        return [
            ['class' => AdminLoggedInFilter::class],
        ];
    }


    public function actionIndex(int $problem_id, string $input = null, string $output = null)
    {
        $this->view->title = 'Justice PLUS Admin - Test Cases';

        $query = $this->problemService->searchTestCasesByProblemID($problem_id, $input, $output);
        $pagination = new Pagination(
            $query->count(),
            intval(Yii::$app->request->get('page', 1)),
            Yii::$app->params['paginationPerPage']
        );

        return $this->render('index', [
            'input' => Html::encode($input),
            'output' => Html::encode($output),
            'problem' => $this->problemService->getProblemByID($problem_id),
            'pagination' => $pagination->build(),
            'records' => $query->offset($pagination->offset())->limit($pagination->limit())->all(),
        ]);
    }


    public function actionNew(int $problem_id)
    {
        $this->view->title = 'Justice PLUS Admin - Add Test Case';
        return $this->render('new', [
            'problem_id' => $problem_id,
        ]);
    }


    public function actionAdd()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        $problem_id = intval(Yii::$app->request->post('problem_id'));
        $input = Yii::$app->request->post('input');
        $output = Yii::$app->request->post('output');

        if (empty($problem_id) || empty($input) || empty($output)) {
            return [
                'code' => 1,
                'message' => 'missing argument(s)'
            ];
        }

        try {
            $this->testCaseService->addTestCase($problem_id, $input, $output);
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


    public function actionEdit(int $id)
    {
        $this->view->title = 'Justice PLUS Admin - Edit Test Case';

        $test_case = $this->testCaseService->getTestCaseByID($id);
        return $this->render('edit', [
            'test_case' => $test_case
        ]);
    }


    public function actionUpdate()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        $test_case_id = intval(Yii::$app->request->post('test_case_id'));
        $input = Yii::$app->request->post('input');
        $output = Yii::$app->request->post('output');

        if (empty($test_case_id) || empty($input) || empty($output)) {
            return [
                'code' => 1,
                'message' => 'missing argument(s)'
            ];
        }

        $test_case = $this->testCaseService->getTestCaseByID($test_case_id);
        if (is_null($test_case)) {
            return [
                'code' => 2,
                'message' => 'test case not exists'
            ];
        }

        if ($this->testCaseService->updateTestCase($test_case, $input, $output)) {
            return [
                'code' => 0,
                'message' => 'OK'
            ];
        } else {
            return [
                'code' => 3,
                'message' => 'update failed'
            ];
        }
    }


    /**
     * @author  liuchao
     * @mail    i@liuchao.me
     * @return array
     * @throws \Exception
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     * @desc
     */
    public function actionDelete()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        $test_case_id = intval(Yii::$app->request->post('test_case_id'));
        if (empty($test_case_id)) {
            return [
                'code' => 1,
                'message' => 'missing argument(s)'
            ];
        }

        $result = $this->testCaseService->deleteTestCase($test_case_id);
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