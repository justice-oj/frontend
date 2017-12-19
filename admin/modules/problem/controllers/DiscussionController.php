<?php

namespace admin\modules\problem\controllers;

use admin\controllers\BaseController;
use admin\filters\AdminLoggedInFilter;
use common\services\DiscussionService;
use common\services\ProblemService;
use Kilte\Pagination\Pagination;
use Yii;
use yii\web\Response;

class DiscussionController extends BaseController {
    protected $problemService;
    protected $discussionService;


    public function __construct(
        $id,
        $module,
        ProblemService $problemService,
        DiscussionService $discussionService,
        $config = []
    ) {
        $this->problemService = $problemService;
        $this->discussionService = $discussionService;
        parent::__construct($id, $module, $config);
    }


    public function behaviors() {
        return [
            ['class' => AdminLoggedInFilter::className()],
        ];
    }


    public function actionIndex(int $problem_id) {
        $page = intval(Yii::$app->request->get('page', 1));
        $this->view->title = 'Justice PLUS Admin - Discussions';

        return $this->render('index', [
            'problem' => $this->problemService->getProblemByID($problem_id),
            'pagination' => (new Pagination(
                $this->discussionService->getTotalDiscussionsCountByProblemID($problem_id),
                $page,
                intval(Yii::$app->params['paginationPerPage'])
            ))->build(),
            'records' => $this->discussionService->getDiscussionsListByProblemID($problem_id, $page),
        ]);
    }


    public function actionEdit(int $discussion_id) {
        $this->view->title = 'Justice PLUS Admin - Edit Discussion';

        $discussion = $this->discussionService->getDiscussionByID($discussion_id);
        return $this->render('edit', [
            'discussion' => $discussion,
            'problem' => $discussion->getProblem()
        ]);
    }


    public function actionUpdate() {
        Yii::$app->response->format = Response::FORMAT_JSON;

        $discussion_id = intval(Yii::$app->request->post('discussion_id'));
        $content = Yii::$app->request->post('content');

        if (empty($discussion_id) || empty($content)) {
            return [
                'code' => 1,
                'message' => 'missing argument(s)'
            ];
        }

        $discussion = $this->discussionService->getDiscussionByID($discussion_id);
        if (is_null($discussion)) {
            return [
                'code' => 2,
                'message' => 'test case not exists'
            ];
        }

        if ($this->discussionService->updateDiscussion($discussion, $content)) {
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


    public function actionDelete() {
        Yii::$app->response->format = Response::FORMAT_JSON;

        $discussion_id = intval(Yii::$app->request->post('discussion_id'));
        if (empty($discussion_id)) {
            return [
                'code' => 1,
                'message' => 'missing argument(s)'
            ];
        }

        $result = $this->discussionService->deleteDiscussion($discussion_id);
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