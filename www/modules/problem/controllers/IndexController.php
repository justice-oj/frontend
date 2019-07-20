<?php

namespace www\modules\problem\controllers;

use admin\controllers\BaseController;
use common\services\ProblemService;
use common\services\TagService;
use www\filters\ProblemExistsFilter;
use www\filters\SubmitRateLimiterFilter;
use www\filters\UserLoggedInFilter;
use Yii;
use yii\helpers\Html;
use yii\web\Response;

class IndexController extends BaseController {
    protected $problemService;
    protected $tagService;


    public function __construct(
        $id,
        $module,
        ProblemService $problemService,
        TagService $tagService,
        $config = []
    ) {
        $this->problemService = $problemService;
        $this->tagService = $tagService;
        parent::__construct($id, $module, $config);
    }


    public function behaviors() {
        return [
            ['class' => UserLoggedInFilter::class],
            ['class' => ProblemExistsFilter::class, 'only' => ['index']],
            ['class' => SubmitRateLimiterFilter::class, 'only' => ['submit']],
        ];
    }


    public function actionIndex(int $problem_id) {
        $problem = $this->problemService->getProblemByID($problem_id);
        $this->view->title = 'Justice PLUS - ' . Html::encode($problem->title);

        return $this->render('index', [
            'problem' => $problem,
            'tags' => $this->tagService->getTagsByProblemID($problem_id),
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