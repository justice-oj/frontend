<?php

namespace www\modules\problem\controllers;

use admin\controllers\BaseController;
use common\models\Discussion;
use common\services\DiscussionService;
use common\services\ProblemService;
use Kilte\Pagination\Pagination;
use www\filters\ProblemExistsFilter;
use www\filters\UserLoggedinFilter;
use Yii;
use yii\helpers\Html;
use yii\web\Response;

class DiscussionsController extends BaseController {
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
            ['class' => UserLoggedinFilter::className()],
            ['class' => ProblemExistsFilter::className(), 'only' => ['index']]
        ];
    }


    public function actionIndex(int $problem_id) {
        $problem = $this->problemService->getProblemByID($problem_id);
        $query = $this->discussionService->getDiscussionByProblemID($problem_id);
        $pagination = new Pagination(
            $query->count(),
            intval(Yii::$app->request->get('page', 1)),
            Yii::$app->params['paginationPerPage']
        );

        $this->view->title = 'Justice PLUS - Discussions of ' . Html::encode($problem->title);

        return $this->render('index', [
            'problem' => $problem,
            'pagination' => $pagination->build(),
            'discussions' => $query->offset($pagination->offset())->limit($pagination->limit())->all(),
            'key' => Yii::$app->params['userUpVoteKey'] . Yii::$app->session->get(Yii::$app->params['userIdKey']),
        ]);
    }


    public function actionAdd() {
        Yii::$app->response->format = Response::FORMAT_JSON;

        $problem_id = intval(Yii::$app->request->post('problem_id'));
        $user_id = Yii::$app->session->get(Yii::$app->params['userIdKey']);
        $content = Yii::$app->request->post('content');

        if (empty($problem_id) || strlen($content) === 0) {
            return [
                'code' => 1,
                'message' => 'Parameter missing.'
            ];
        }

        if ($this->discussionService->addDiscussion($problem_id, $user_id, $content)) {
            return [
                'code' => 0,
                'message' => 'OK'
            ];
        } else {
            return [
                'code' => 2,
                'message' => 'add discussion failed'
            ];
        }
    }


    public function actionUpVote() {
        Yii::$app->response->format = Response::FORMAT_JSON;

        $discussion_id = intval(Yii::$app->request->post('discussion_id'));
        $key = Yii::$app->params['userUpVoteKey'] . Yii::$app->session->get(Yii::$app->params['userIdKey']);
        $discussion = $this->discussionService->getDiscussionByID($discussion_id);

        if (is_null($discussion)) {
            return [
                'code' => 1,
                'message' => 'discussion not exists'
            ];
        }

        if (Yii::$app->redis->getbit($key, $discussion_id)) {
            Yii::$app->redis->setbit($key, $discussion_id, Discussion::NOT_UP_VOTED);
            $delta = -1;
        } else {
            Yii::$app->redis->setbit($key, $discussion_id, Discussion::ALREADY_UP_VOTED);
            $delta = 1;
        }

        if ($this->discussionService->updateDiscussionUpVotes($discussion, $delta)) {
            return [
                'code' => 0,
                'message' => 'OK',
                'data' => [
                    'current' => Yii::$app->redis->getbit($key, $discussion_id) == Discussion::ALREADY_UP_VOTED,
                    'count' => $discussion->up_vote
                ]
            ];
        } else {
            return [
                'code' => 2,
                'message' => 'update failed'
            ];
        }
    }
}