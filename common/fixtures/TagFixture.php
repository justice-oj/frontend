<?php

namespace common\fixtures;

use yii\test\ActiveFixture;

class TagFixture extends ActiveFixture {
    public $modelClass = 'common\models\Tag';

    protected function getData() {
        return [
            ['name' => 'Array'],
            ['name' => 'String'],
            ['name' => 'Math'],
            ['name' => 'Tree'],
            ['name' => 'Hash Table'],
            ['name' => 'Dynamic Programming'],
            ['name' => 'Depth First Search'],
            ['name' => 'Binary Search'],
            ['name' => 'Backtracking'],
            ['name' => 'Breadth First Search'],
            ['name' => 'Stack'],
            ['name' => 'Linked List'],
            ['name' => 'Bit Manipulation'],
            ['name' => 'Greedy'],
            ['name' => 'Sort'],
            ['name' => 'Heap'],
            ['name' => 'Divide and Conquer'],
            ['name' => 'Graph'],
            ['name' => 'Trie'],
            ['name' => 'Union Find'],
            ['name' => 'Binary Search Tree'],
            ['name' => 'Binary Indexed Tree'],
            ['name' => 'Queue'],
            ['name' => 'Segment Tree'],
            ['name' => 'Topological Sort'],
            ['name' => 'Recursion'],
            ['name' => 'Reservoir Sampling'],
            ['name' => 'Geometry'],
        ];
    }
}