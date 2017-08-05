<?php

namespace www\presenters;

use common\models\Submission;

class SubmissionPresenter {
    /**
     * @author  liuchao
     * @mail    i@liuchao.me
     * @param   int $language
     * @return  string submission's language
     */
    public function showLanguage(int $language) {
        if ($language === Submission::LANGUAGE_C) {
            return 'C';
        } elseif ($language === Submission::LANGUAGE_CPP) {
            return 'C++';
        } elseif ($language === Submission::LANGUAGE_PYTHON2) {
            return 'Python 2';
        } elseif ($language === Submission::LANGUAGE_PYTHON3) {
            return 'Python 3';
        } elseif ($language === Submission::LANGUAGE_JAVA) {
            return 'Java';
        } else {
            return 'Other';
        }
    }


    /**
     * @author  liuchao
     * @mail    i@liuchao.me
     * @param   int $status
     * @return  string submission's status
     */
    public function showStatus(int $status) {
        if ($status == Submission::STATUS_QUEUE) {
            return 'In Queue';
        } elseif ($status == Submission::STATUS_AC) {
            return 'Accepted';
        } elseif ($status == Submission::STATUS_CE) {
            return 'Compile Error';
        } elseif ($status == Submission::STATUS_RE) {
            return 'Runtime Error';
        } elseif ($status == Submission::STATUS_TLE) {
            return 'Time Limit Exceeded';
        } elseif ($status == Submission::STATUS_MLE) {
            return 'Memory Limit Exceeded';
        } elseif ($status == Submission::STATUS_WA) {
            return 'Wrong Answer';
        } else {
            return 'Unknown';
        }
    }


    /**
     * @author  liuchao
     * @mail    i@liuchao.me
     * @param   int $status
     * @return  string submission's runtime
     * @desc
     */
    public function showRuntime(int $status) {
        if ($status == -1) {
            return 'N/A';
        } else {
            return $status . ' ms';
        }
    }


    /**
     * @author  liuchao
     * @mail    i@liuchao.me
     * @param   int $status
     * @return  string submission's memory cost
     * @desc
     */
    public function showMemory(int $status) {
        if ($status == -1) {
            return 'N/A';
        } else {
            return $status . ' MB';
        }
    }
}