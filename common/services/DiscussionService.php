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
     * @param   int $problem_id
     * @return  \yii\db\ActiveQuery
     * @desc
     */
    public function getDiscussionByProblemID(int $problem_id) {
        return Discussion::find()
            ->where(['problem_id' => $problem_id])
            ->orderBy(['id' => SORT_DESC])
            ->all();
    }
}