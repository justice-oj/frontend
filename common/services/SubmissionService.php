<?php

namespace common\services;

use common\models\Submission;

/**
 * Class SubmissionService
 * @package common\services
 */
class SubmissionService {
    /**
     * @author  liuchao
     * @mail    i@liuchao.me
     * @param int $id
     * @return \common\models\Submission|null
     * @desc
     */
    public function getSubmissionByID(int $id) {
        return Submission::findOne($id);
    }


    /**
     * @author  liuchao
     * @mail    i@liuchao.me
     * @param  int $user_id
     * @return \yii\db\ActiveQuery
     * @desc
     */
    public function getSubmissionsByUserID(int $user_id) {
        return Submission::find()->where(['user_id' => $user_id]);
    }
}