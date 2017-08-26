<?php

namespace common\services;

use common\models\Discussion;

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
     * @param   Discussion $discussion
     * @param   int $delta
     * @desc    update up-votes of discussion
     * @return  bool
     */
    public function updateDiscussionUpVotes($discussion, int $delta) {
        $discussion->up_vote = $discussion->up_vote + $delta;
        return $discussion->save();
    }
}