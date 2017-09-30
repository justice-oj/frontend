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

        $page = intval(Yii::$app->request->get('page', 1));
        $limit = intval(Yii::$app->params['paginationPerPage']);
        $offset = $limit * ($page - 1);
        $sql = <<<SQL
SELECT
  d.id         AS id,
  d.created_at AS created_at,
  u.email      AS email,
  u.username   AS username,
  d.up_vote    AS up_vote,
  d.content    AS content
FROM t_discussion d
  JOIN (SELECT id FROM t_discussion ORDER BY id DESC LIMIT $offset, $limit) t ON d.id = t.id
  LEFT JOIN t_user u ON d.user_id = u.id
WHERE d.problem_id = $problem_id
ORDER BY d.id DESC;
SQL;

        $pagination = new Pagination($this->discussionService->getTotalDiscussionsCountByProblemID($problem_id), $page, $limit);
        $this->view->title = 'Justice PLUS - Discussions of ' . Html::encode($problem->title);

        return $this->render('index', [
            'problem' => $problem,
            'pagination' => $pagination->build(),
            'discussions' => Yii::$app->db->createCommand($sql)->queryAll(),
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

        if (Yii::$app->get('redis')->getbit($key, $discussion_id)) {
            Yii::$app->get('redis')->setbit($key, $discussion_id, Discussion::NOT_UP_VOTED);
            $delta = -1;
        } else {
            Yii::$app->get('redis')->setbit($key, $discussion_id, Discussion::ALREADY_UP_VOTED);
            $delta = 1;
        }

        $username = Yii::$app->session->get(Yii::$app->params['userNameKey']);
        if ($this->discussionService->updateDiscussionVotes($username, $discussion, $delta)) {
            return [
                'code' => 0,
                'message' => 'OK',
                'data' => [
                    'current' => Yii::$app->get('redis')->getbit($key, $discussion_id) == Discussion::ALREADY_UP_VOTED,
                    'count' => $discussion->up_vote
                ]
            ];
        } else {
            return [
                'code' => 2,
                'message' => 'vote failed'
            ];
        }
    }
}