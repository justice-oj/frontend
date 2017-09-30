<?php

namespace admin\modules\problem\controllers;

use admin\controllers\BaseController;
use admin\filters\AdminLoggedinFilter;
use common\services\ProblemService;
use common\services\ProblemTagService;
use common\services\TagService;
use Yii;
use yii\web\Response;

class TagController extends BaseController {
    protected $problemService;
    protected $problemTagService;
    protected $tagService;


    public function __construct(
        $id,
        $module,
        ProblemService $problemService,
        ProblemTagService $problemTagService,
        TagService $tagService,
        $config = []
    ) {
        $this->problemService = $problemService;
        $this->problemTagService = $problemTagService;
        $this->tagService = $tagService;
        parent::__construct($id, $module, $config);
    }


    public function behaviors() {
        return [
            ['class' => AdminLoggedinFilter::className()],
        ];
    }


    public function actionIndex(int $problem_id) {
        $this->view->title = 'Justice PLUS Admin - Problem Tags';

        return $this->render('index', [
            'tags' => $this->tagService->getTags(),
            'problem' => $this->problemService->getProblemByID($problem_id),
            'records' => $this->tagService->getTagsByProblemID($problem_id),
        ]);
    }


    public function actionAdd() {
        Yii::$app->response->format = Response::FORMAT_JSON;

        $problem_id = intval(Yii::$app->request->post('problem_id'));
        $tag_id = intval(Yii::$app->request->post('tag_id'));

        if (empty($problem_id) || empty($tag_id)) {
            return [
                'code' => 1,
                'message' => 'missing argument(s)'
            ];
        }

        try {
            $this->problemTagService->addProblemTag($tag_id, $problem_id);
            return [
                'code' => 0,
                'message' => 'OK'
            ];
        } catch (\Exception $e) {
            return [
                'code' => 2,
                'message' => $e->getMessage()
            ];
        }
    }


    public function actionDelete() {
        Yii::$app->response->format = Response::FORMAT_JSON;

        $problem_tag_id = intval(Yii::$app->request->post('problem_tag_id'));
        if (empty($problem_tag_id)) {
            return [
                'code' => 1,
                'message' => 'missing `problem_tag_id`'
            ];
        }

        $result = $this->problemTagService->deleteProblemTag($problem_tag_id);
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