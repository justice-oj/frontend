<?php

namespace common\fixtures;

use yii\test\ActiveFixture;

class ProblemFixture extends ActiveFixture {
    public $modelClass = 'common\models\Problem';

    protected function getData() {
        return [
            [
                'title' => 'File Retrieval',
                'description' => 'The operating system of your computer indexes the files on your hard disk based on their contents, and provides textual search over them. The content of each file is a non-empty string of lowercase letters. To do a search, you specify a key, which is also a non-empty string of lowercase letters. The result is a list of all the files that contain the key as a substring. A string s is a substring of a string t if t contains all characters of s as a contiguous sequence. For instance, "foofoo", "cafoo", "foota" and "foo" all contain "foo" as a substring, while "foa", "fofo", "fioo" and “oofo" do not.<br>You know the content of each file on your hard disk, and wonder whether each subset of the files is searchable. A subset of the files is searchable if there exists at least one key that produces exactly the list of those files as a result. Given the contents of the files on your hard disk, you are asked to compute the number of non-empty searchable subsets.',
                'input' => '<p>Each test case is described using several lines. The first line contains an integer <strong>F</strong> representing the number of files on your hard disk (1 ≤ <strong>F</strong> ≤ 60). Each of the next <strong>F</strong> lines indicates the content of one of the files. The content of a file is a non-empty string of at most 10<sup>4</sup> characters; each character is one of the 26 standard lowercase letters (from \'a\' to \'z\').</p>
<p>The last test case is followed by a line containing one zero.</p>',
                'output' => 'For each test case output a line with an integer representing the number of non-empty searchable subsets.',
                'sample_input' => '6
form
formal
malformed
for
man
remake
3
cool
cool
old
0',
                'sample_output' => '11
3',
                'level' => 7,
                'runtime_limit' => 8000,
                'memory_limit' => 64,
                'submission_count' => 123,
                'accepted_count' => 52,
                'created_at' => '2012-12-21 00:00:00',
                'updated_at' => '2014-08-02 23:46:03',
            ],
        ];
    }
}