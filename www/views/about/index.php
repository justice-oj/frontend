<?php

use www\widgets\common\GoogleAdSenseWidget;

?>

<div class="ui piled segment">
    <div class="ui left close rail">
        <div class="ui basic segment">
            <?= /** @noinspection PhpUnhandledExceptionInspection */ GoogleAdSenseWidget::widget(['type' => '300x600']) ?>
        </div>
    </div>
    <div class="ui right close rail">
        <div class="ui basic segment">
            <?= /** @noinspection PhpUnhandledExceptionInspection */ GoogleAdSenseWidget::widget(['type' => '300x600']) ?>
        </div>
    </div>
    <h2 class="ui center aligned icon header">
        <i class="circular sitemap icon"></i>
        About Justice
    </h2>
    <p style="font-size: large">Justice is an open source <a href="https://en.wikipedia.org/wiki/Online_judge" target="_blank">online judge</a> platform which now supports three languages: C, CPP and Java.</p>
    <p style="font-size: large">Like the other OJ platforms, we can have discussions, high quality articles and a ranking list of all users here. However, we won't provide algorithm problems as many as possible to practice your programming skills, instead we are now focusing on linux kernel-based sandbox and software similarity detecting. For more information, please see <a href="https://tech.liuchao.me/tag/justice-oj/" target="_blank">here</a>.</p>
    <p style="font-size: large">Contact <code>aUBsaXVjaGFvLm1l</code> for any question you may have, feed backs are also warmly welcomed. &#128527;</p>
    <h2 class="ui center aligned icon header">
        <i class="circular users icon"></i>
        About me
    </h2>
    <div class="ui three column grid">
        <div class="column">
            <div class="ui fluid card">
                <div class="image">
                    <img src="https://s.gravatar.com/avatar/cf16f342d42e86cbded5a49974d4e3e0?s=400">
                </div>
                <div class="content">
                    <div class="header">Chao Liu</div>
                    <div class="meta">
                        Developer
                    </div>
                    <div class="description">
                        Web / DevOps / Machine Learning
                    </div>
                </div>
                <div class="extra content">
                    <span class="right floated">Since Dec 21, 2016</span>
                    <span>
                        <a href="https://tech.liuchao.me" target="_blank">
                            <i class="wordpress large icon"></i>
                        </a>
                        <a href="https://github.com/liupangzi" target="_blank">
                            <i class="github large icon"></i>
                        </a>
                        <a href="https://stackoverflow.com/users/849310/holyghost" target="_blank">
                            <i class="stack overflow large icon"></i>
                        </a>
                        <a href="https://www.linkedin.com/in/liumangchao/" target="_blank">
                            <i class="linkedin large icon"></i>
                        </a>
                        <a href="https://twitter.com/liu_chao" target="_blank">
                            <i class="twitter large icon"></i>
                        </a>
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>