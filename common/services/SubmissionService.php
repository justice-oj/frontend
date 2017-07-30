<?php

namespace common\services;

use common\models\Submission;

class SubmissionService {
    protected $submission = null;


    public function __construct(Submission $submission) {
        $this->submission = $submission;
    }


    /**
     * @author  liuchao
     * @mail    i@liuchao.me
     * @param int $problem_id
     * @desc
     */
    public function findSubmissionsByProblemID(int $problem_id) {
        return Submission::find()->where(['problem_id' => $problem_id]);
    }
}