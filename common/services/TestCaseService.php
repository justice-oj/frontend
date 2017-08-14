<?php

namespace common\services;

use common\models\TestCase;

/**
 * Class TestCaseService
 * @package common\services
 */
class TestCaseService {
    /**
     * @author  liuchao
     * @mail    i@liuchao.me
     * @param   int $id
     * @return  \common\models\TestCase|null
     * @desc
     */
    public function getTestCaseByID(int $id) {
        return TestCase::findOne($id);
    }


    /**
     * @author  liuchao
     * @mail    i@liuchao.me
     * @param   int $problem_id
     * @param   string $input
     * @param   string $output
     * @return int
     * @desc
     */
    public function addTestCase(int $problem_id, string $input, string $output) {
        $test_case = new TestCase();
        $test_case->problem_id = $problem_id;
        $test_case->input = $input;
        $test_case->output = $output;
        $test_case->save();

        return $test_case->id;
    }


    /**
     * @author  liuchao
     * @mail    i@liuchao.me
     * @param   \common\models\TestCase $test_case
     * @param   string $input
     * @param   string $output
     * @desc
     * @return  bool
     */
    public function updateTestCase($test_case, string $input, string $output) {
        $test_case->input = $input;
        $test_case->output = $output;
        return $test_case->save();
    }


    /**
     * @author  liuchao
     * @mail    i@liuchao.me
     * @param   int $test_case_id
     * @return  false|int
     * @desc
     */
    public function deleteTestCase(int $test_case_id) {
        return TestCase::findOne($test_case_id)->delete();
    }
}