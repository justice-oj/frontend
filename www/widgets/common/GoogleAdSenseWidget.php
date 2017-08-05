<?php

namespace www\widgets\common;

use yii\base\Widget;

class GoogleAdSenseWidget extends Widget {
    public $type;

    public function run() {
        $size = [
            '300x600' => 'display:inline-block;width:300px;height:600px'
        ];

        return $this->render('google', [
            'style' => $size[$this->type] ?? 'display:block'
        ]);
    }
}