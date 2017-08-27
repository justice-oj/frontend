<?php

namespace common\services;

use common\models\Discussion;
use common\models\Problem;
use common\models\User;
use www\Presenters\UserPresenter;

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
     * @return  \yii\db\ActiveQuery
     * @desc
     */
    public function getDiscussionByProblemID(int $problem_id) {
        return Discussion::find()->where(['problem_id' => $problem_id]);
    }


    /**
     * @author  liuchao
     * @mail    i@liuchao.me
     * @param int $problem_id
     * @param int $user_id
     * @param string $content
     * @return bool
     * @desc
     */
    public function addDiscussion(int $problem_id, int $user_id, string $content) {
        $data = json_decode($content);
        foreach ($data->ops as $block) {
            if (preg_match('/^@\w+$/', $block->insert, $match)) {
                $block->attributes->link = '/profile?name=' . substr($match[0], 1);
            }
        }

        $discussion = new Discussion();
        $discussion->problem_id = $problem_id;
        $discussion->user_id = $user_id;
        $discussion->content = json_encode($data);
        return $discussion->save();
    }


    /**
     * @author  liuchao
     * @mail    i@liuchao.me
     * @param   string $username
     * @param   \common\models\Discussion $discussion
     * @param   int $delta
     * @return bool
     * @desc    update up-votes of discussion
     */
    public function updateDiscussionVotes($username, $discussion, int $delta) {
        $upvote_user = User::findOne(['username' => $username]);
        $notice_user = User::findOne($discussion->user_id);

        if ($notice_user->id == $upvote_user->id) {
            return false;
        }

        // notice if this is an up-vote
        if ($delta > 0) {
            $problem = Problem::findOne($discussion->problem_id);
            $user_presenter = new UserPresenter();
            $content = <<< NOTICE
    <div class="item">
        <img class="ui avatar image" src="{$user_presenter->showAvatar($upvote_user->email, 28)}">
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

        $discussion->up_vote = $discussion->up_vote + $delta;
        return $discussion->save();
    }
}