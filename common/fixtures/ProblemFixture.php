<?php

namespace common\fixtures;

use yii\test\ActiveFixture;

class ProblemFixture extends ActiveFixture {
    public $modelClass = 'common\models\Problem';

    protected function getData() {
        return [
            [
                'title' => 'The Longest Common Subsequence',
                'description' => '<h2>Description</h2>A subsequence is a sequence that can be derived from another sequence by deleting some elements without changing the order of the remaining elements.  Longest common subsequence (<em>LCS</em>) of 2 sequences is a subsequence, with maximal length, which is common to both the sequences. <br><br>Given two sequence of integers, \(A = \left [ a_{1}, a_{2}, ... a_{n} \right ]\) and \(B = \left [ b_{1}, b_{2}, ... b_{m} \right ]\), find <b>any one</b> longest common subsequence.<br><br>In case multiple solutions exist, print any of them. It is guaranteed that at least one non-empty common subsequence will exist.<h2>Input</h2>First line contains two space separated integers, \(n\) and \(m\), where \(n\) is the size of sequence \(A\), while \(m\) is size of sequence \(B\). In next line there are \(n\) space separated integers representing sequence \(A\), and in third line there are \(m\) space separated integers representing sequence \(B\).<pre>n m
A<sub>1</sub> A<sub>2</sub> ... A<sub>n</sub>
B<sub>1</sub> B<sub>2</sub> ... B<sub>m</sub></pre><h2>Constraints</h2>$$1 \leqslant n \leqslant 100$$ $$1 \leqslant m \leqslant 100$$ $$1 \leqslant a_{i} < 1000 \wedge \forall i: i \in \left [ 1, n \right ]$$ $$1 \leqslant b_{j} < 1000 \wedge \forall j: j \in \left [ 1, m \right ]$$<h2>Output</h2>Print the longest common subsequence and each element should be separated by at least one white-space. In case of multiple answers, print any one of them.<h2>Sample Input</h2>
<pre>5 6
1 2 3 4 1
3 4 1 2 1 3</pre>
<h2>Sample Output</h2><pre>1 2 3</pre><h2>Explanation</h2><p>There is no common subsequence with length larger than 3. And "1 2 3", "1 2 1", "3 4 1" are all correct answers.</p>',
                'level' => 7,
                'runtime_limit' => 8000,
                'memory_limit' => 64,
            ],
            [
                'title' => 'Time Conversion',
                'description' => '<h2>Description</h2>Given a time in 12-hour AM/PM format, convert it to military (24-hour) time.<h2>Input</h2>A single string containing a time in 12-hour clock format.<h2>Output</h2>Convert and print the given time in 24-hour format,<h2>Sample Input</h2>
<pre>07:05:45PM</pre><h2>Sample Output</h2><pre>19:05:45</pre>',
                'level' => 1,
                'runtime_limit' => 1000,
                'memory_limit' => 64,
            ],
        ];
    }
}