<?php

namespace common\services;

use common\models\Discussion;
use common\models\Problem;
use common\models\User;
use www\presenters\UserPresenter;
use Yii;

/**
 * Class DiscussionService
 * @package common\services
 */
class DiscussionService {
    /**
     * @author  liuchao
     * @mail    i@liuchao.me
     * @param   int $id
     * @return  Discussion|null
     * @desc
     */
    public function getDiscussionByID(int $id) {
        return Discussion::findOne($id);
    }


    /**
     * @author  liuchao
     * @mail    i@liuchao.me
     * @param   int $problem_id
     * @return  int
     * @desc
     */
    public function getTotalDiscussionsCountByProblemID(int $problem_id) {
        return intval(Discussion::find()->where(['problem_id' => $problem_id])->count());
    }


    /**
     * @author  liuchao
     * @mail    i@liuchao.me
     * @param   int $problem_id
     * @param   int $user_id
     * @param   string $content
     * @return  bool
     * @desc
     */
    public function addDiscussion(int $problem_id, int $user_id, string $content) {
        $notice_user_list = [];
        $data = json_decode($content);
        foreach ($data->ops as $block) {
            if (is_string($block->insert) && preg_match('/^@\w+$/', $block->insert, $match)) {
                $username = substr($match[0], 1);
                $block->attributes->link = '/profile?name=' . $username;
                $notice_user_list[] = $username;
            }
        }

        $discussion = new Discussion();
        $discussion->problem_id = $problem_id;
        $discussion->user_id = $user_id;
        $discussion->content = json_encode($data);

        if ($discussion->save()) {
            $problem = $discussion->getProblem();
            $reply_user = User::findOne($user_id);
            $user_presenter = new UserPresenter();

            foreach (array_diff(array_unique($notice_user_list), [$reply_user->username]) as $username) {
                $content = <<< NOTICE
    <div class="item">
        <img class="ui avatar image" src="{$user_presenter->showAvatar($reply_user->email, 30)}">
        <div class="content">
            <a class="header" href="/profile?name={$reply_user->username}">{$reply_user->username}</a>
            <div class="description">Mentioned you under discussions of problem 
            <a href="/problem/discussions?problem_id={$discussion->problem_id}#L{$discussion->id}">
                <b>{$problem->title}</b>
            </a>
            </div>
        </div>
    </div>
NOTICE;
                NotificationService::addNotice($username, $content);
            }
            return true;
        } else {
            return false;
        }
    }


    /**
     * @author  liuchao
     * @mail    i@liuchao.me
     * @param   \common\models\Discussion $discussion
     * @param   string $content
     * @return  bool
     * @desc
     */
    public function updateDiscussion($discussion, $content) {
        $discussion->content = $content;
        return $discussion->save();
    }


    /**
     * @author  liuchao
     * @mail    i@liuchao.me
     * @param   int $discussion_id
     * @return  false|int
     * @throws \Exception
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     * @desc
     */
    public function deleteDiscussion(int $discussion_id) {
        return Discussion::findOne($discussion_id)->delete();
    }


    /**
     * @author  liuchao
     * @mail    i@liuchao.me
     * @param   string $username
     * @param   \common\models\Discussion $discussion
     * @param   int $delta
     * @return  bool
     * @desc    update up-votes of discussion
     */
    public function updateDiscussionVotes($username, $discussion, int $delta) {
        $upvote_user = User::findOne(['username' => $username]);
        $notice_user = User::findOne($discussion->user_id);

        // notice user and upvote user cannot be the same
        if ($notice_user->id == $upvote_user->id) {
            return false;
        }

        // notice if this is an up-vote but not a down-vote
        if ($delta > 0) {
            $problem = Problem::findOne($discussion->problem_id);
            $user_presenter = new UserPresenter();
            $content = <<< NOTICE
    <div class="item">
        <img class="ui avatar image" src="{$user_presenter->showAvatar($upvote_user->email, 30)}">
        <div class="content">
            <a class="header" href="/profile?name={$upvote_user->username}">{$upvote_user->username}</a>
            <div class="description">Up-voted your discussion under problem 
            <a href="/problem/discussions?problem_id={$problem->id}#L{$discussion->id}">
                <b>{$problem->title}</b>
            </a>
            </div>
        </div>
    </div>
NOTICE;
            NotificationService::addNotice($notice_user->username, $content);
        }

        //update DB counter
        $discussion->up_vote = $discussion->up_vote + $delta;
        return $discussion->save();
    }


    /**
     * @author  liuchao
     * @mail    i@liuchao.me
     * @param   int $problem_id
     * @param   int $page
     * @return  array
     * @desc    get discussions list by $problem_id on page $page
     * @throws \yii\db\Exception
     */
    public function getDiscussionsListByProblemID(int $problem_id, int $page) {
        $limit = intval(Yii::$app->params['paginationPerPage']);
        $offset = $limit * ($page - 1);

        $sql = <<< SQL
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

        return Yii::$app->db->createCommand($sql)->queryAll();
    }
}