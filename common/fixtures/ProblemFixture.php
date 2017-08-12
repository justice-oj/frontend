<?php

namespace common\fixtures;

use yii\test\ActiveFixture;

class ProblemFixture extends ActiveFixture {
    public $modelClass = 'common\models\Problem';

    protected function getData() {
        return [
            [
                'title' => 'Time Conversion',
                'description' => '{"ops":[{"insert":"Given a time in "},{"attributes":{"link":"https://en.wikipedia.org/wiki/12-hour_clock"},"insert":"12-hour AM/PM format"},{"insert":", convert it to military (24-hour) time.\n\n"},{"attributes":{"bold":true},"insert":"Note:"},{"insert":" Midnight is "},{"attributes":{"bold":true},"insert":"12:00:00AM"},{"insert":" on a 12-hour clock, and "},{"attributes":{"bold":true},"insert":"00:00:00"},{"insert":" on a 24-hour clock. Noon is "},{"attributes":{"bold":true},"insert":"12:00:00PM"},{"insert":" on a 12-hour clock, and "},{"attributes":{"bold":true},"insert":"12:00:00"},{"insert":" on a 24-hour clock.\n\n"},{"attributes":{"bold":true},"insert":"Input"},{"attributes":{"header":1},"insert":"\n"},{"insert":"\nA single string containing a time in 12-hour clock format (i.e.: "},{"attributes":{"bold":true},"insert":"hh:mm:ssAM"},{"insert":" or "},{"attributes":{"bold":true},"insert":"hh:mm:ssPM"},{"insert":"), where "},{"insert":{"formula":"01 \\\\leqslant hh \\\\leqslant 12"}},{"insert":" and "},{"insert":{"formula":"01 \\\\leqslant mm, ss \\\\leqslant 59"}},{"insert":".\n\n"},{"attributes":{"bold":true},"insert":"Output"},{"attributes":{"header":1},"insert":"\n"},{"insert":"\nConvert and print the given time in 24-hour format, where "},{"insert":{"formula":"00 \\\\leqslant hh \\\\leqslant 23"}},{"insert":".\n\n"},{"attributes":{"bold":true},"insert":"Sample Input"},{"attributes":{"header":1},"insert":"\n"},{"insert":"\n07:05:45PM"},{"attributes":{"code-block":true},"insert":"\n"},{"insert":"\n"},{"attributes":{"bold":true},"insert":"Sample Output"},{"attributes":{"header":1},"insert":"\n"},{"insert":"\n19:05:45"},{"attributes":{"code-block":true},"insert":"\n"}]}',
                'level' => 1,
                'runtime_limit' => 1000,
                'memory_limit' => 64,
            ],
        ];
    }
}