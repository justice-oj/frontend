<?php

use www\widgets\common\GoogleAdSenseWidget;

?>

<div class="ui teal stacked segment">
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
    <h1 class="ui center aligned icon header">
        About Justice
    </h1>
    <p style="font-size: large">Justice is an experimental <a href="https://en.wikipedia.org/wiki/Online_judge" target="_blank">online judge</a> platform, which is now focusing on linux kernel-based sandbox and software similarity detecting. Like the other online judge systems, Justice also provides discussions and high quality articles for each problem.</p>
    <p style="font-size: large">Contact <code>aUBsaXVjaGFvLm1l</code> for any question you may have, feed backs are also warmly welcomed. &#128527;</p>
</div>