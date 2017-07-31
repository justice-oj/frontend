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
            return 'JAVA';
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
            return 'In Queue';
        } elseif ($status == Submission::STATUS_CE) {
            return 'In Queue';
        } elseif ($status == Submission::STATUS_RE) {
            return 'In Queue';
        } elseif ($status == Submission::STATUS_TLE) {
            return 'In Queue';
        } elseif ($status == Submission::STATUS_MLE) {
            return 'In Queue';
        } elseif ($status == Submission::STATUS_WA) {
            return 'In Queue';
        } else {
            return 'Unknown';
        }
    }
}