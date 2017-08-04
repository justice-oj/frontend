<?php

namespace www\presenters;

use common\models\Problem;

class ProblemPresenter {
    /**
     * @author  liuchao
     * @mail    i@liuchao.me
     * @param   int $status problem solved status
     * @return  String user's AC percentage
     */
    public function showTRClass(int $status) {
        if ($status === Problem::STATUS_TRIED) {
            return 'negative';
        } elseif ($status === Problem::STATUS_SOLVED) {
            return 'positive';
        } else {
            return '';
        }
    }


    /**
     * @author  liuchao
     * @mail    i@liuchao.me
     * @param   int $status problem solved status
     * @return  String user's AC percentage
     */
    public function showProblemIcon(int $status) {
        if ($status === Problem::STATUS_TRIED) {
            return ' <i class="remove icon"></i>';
        } elseif ($status === Problem::STATUS_SOLVED) {
            return ' <i class="checkmark icon"></i>';
        } else {
            return '';
        }
    }


    /**
     * @author  liuchao
     * @mail    i@liuchao.me
     * @param   int $accepted
     * @param   int $total
     * @return  String user's AC percentage
     */
    public function showProblemRate(int $accepted, int $total) {
        $ac_rate = $total === 0 ? 0.0 : $accepted * 100 / $total;

        if ($ac_rate > 80.0) {
            $color = 'green';
        } elseif ($ac_rate > 60.0) {
            $color = 'blue';
        } elseif ($ac_rate > 40.0) {
            $color = 'teal';
        } elseif ($ac_rate > 20.0) {
            $color = 'yellow';
        } else {
            $color = 'red';
        }

        return sprintf('<div class="ui horizontal %s mini statistic"><div class="value">%.2f %%</div></div>', $color, $ac_rate);
    }
}