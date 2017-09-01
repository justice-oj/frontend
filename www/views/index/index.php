<?php

use www\widgets\common\GoogleAdSenseWidget;

?>

<div class="ui piled segments">
    <div class="ui left close rail">
        <div class="ui basic segment">
            <?= GoogleAdSenseWidget::widget(['type' => '300x600']) ?>
        </div>
    </div>
    <div class="ui right close rail">
        <div class="ui basic segment">
            <?= GoogleAdSenseWidget::widget(['type' => '300x600']) ?>
        </div>
    </div>
    <div class="ui segment">
        <h2>System specification</h2>
    </div>
    <div class="ui secondary segment">
        <p>CentOS 7 (Linux 3.10.0-514.6.2.el7.x86_64)</p>
    </div>
    <div class="ui segment">
        <h2>Supported languages</h2>
    </div>
    <div class="ui secondary segment">
        <div class="ui bulleted list">
            <div class="item">GNU C(-std=gnu11)</div>
            <div class="item">GNU C++(-std=gnu++11)</div>
            <div class="item">Java 8</div>
            <div class="item">Perl 6</div>
            <div class="item">Python 3</div>
        </div>
    </div>
    <div class="ui segment">
        <h2>Verdicts</h2>
    </div>
    <div class="ui secondary segment">
        <div class="ui bulleted list">
            <div class="item">
                <h4 class="ui grey header">In Queue:</h4>
                The submission is still in the judge queue.
            </div>
            <div class="item">
                <h4 class="ui green header">Accepted:</h4>
                Your program is correct, congratulations!
            </div>
            <div class="item">
                <h4 class="ui orange header">Compile Error:</h4>
                Your program can't be compiled, please check again.
            </div>
            <div class="item">
                <h4 class="ui teal header">Runtime Error:</h4>
                Something went wrong during the execution.
            </div>
            <div class="item">
                <h4 class="ui yellow header">Time Limit Exceeded:</h4>
                Your program runs longer than specified time limitation.
            </div>
            <div class="item">
                <h4 class="ui olive header">Memory Limit Exceeded:</h4>
                Your program allocates more memory than the specified memory limitation.
            </div>
            <div class="item">
                <h4 class="ui red header">Wrong Answer:</h4>
                Your program is incorrect, please check again.
            </div>
        </div>
    </div>
</div>