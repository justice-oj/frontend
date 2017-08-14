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
            return '<h4 class="ui grey header">In Queue</h4>';
        } elseif ($status == Submission::STATUS_AC) {
            return '<h4 class="ui green header">Accepted</h4>';
        } elseif ($status == Submission::STATUS_CE) {
            return '<h4 class="ui orange header">Compile Error</h4>';
        } elseif ($status == Submission::STATUS_RE) {
            return '<h4 class="ui teal header">Runtime Error</h4>';
        } elseif ($status == Submission::STATUS_TLE) {
            return '<h4 class="ui yellow header">Time Limit Exceeded</h4>';
        } elseif ($status == Submission::STATUS_MLE) {
            return '<h4 class="ui olive header">Memory Limit Exceeded</h4>';
        } elseif ($status == Submission::STATUS_WA) {
            return '<h4 class="ui red header">Wrong Answer</h4>';
        } else {
            return '<h4 class="ui brown header">Unknown</h4>';
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


    /**
     * @author  liuchao
     * @mail    i@liuchao.me
     * @param   Submission $submission
     * @desc
     * @return string
     */
    public function showWAMessage($submission) {
        if ($submission->status == Submission::STATUS_WA) {
            return <<< BLOCK
            <div class="ui horizontal segments">
                <div class="ui segment">
                    <div class="ui header">Input: </div>
                    <pre>{$submission->input}</pre>
                </div>
                <div class="ui segment">
                    <div class="ui red header">Output: </div>
                    <pre>{$submission->output}</pre>
                </div>
                <div class="ui segment">
                    <div class="ui green header">Expected: </div>
                    <pre>{$submission->expected}</pre>
                </div>
            </div>
BLOCK;
        }
        return '';
    }


    /**
     * @author  liuchao
     * @mail    i@liuchao.me
     * @param   Submission $submission
     * @return  string
     * @desc
     */
    public function showErrorMessage($submission) {
        if ($submission->status != Submission::STATUS_QUEUE
            && $submission->status != Submission::STATUS_AC
            && $submission->status != Submission::STATUS_WA
        ) {
            return <<< BLOCK
            <div class="ui red message"><div class="header">Error: </div><pre>{$submission->error}</pre></div>
BLOCK;
        }
        return '';
    }
}