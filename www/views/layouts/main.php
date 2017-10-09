<?php

use common\services\NotificationService;
use yii\helpers\Html;

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" href="/favicon-32x32.png" sizes="32x32">
    <link rel="icon" type="image/png" href="/favicon-16x16.png" sizes="16x16">
    <link rel="manifest" href="/manifest.json">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.2.11/semantic.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.2.11/semantic.min.js"></script>
    <?= Html::csrfMetaTags() ?>
    <title><?= $this->title ?></title>
    <style type="text/css">
        body {
            background-color: #FFFFFF;
        }
        .ui.menu .item img.logo {
            margin-right: 1.5em;
        }
        .main.container {
            margin-top: 7em;
        }
        .ui.footer.segment {
            margin: 3em 0em 0em;
            padding: 3em 0em;
        }
    </style>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
<div class="ui fixed inverted menu">
    <div class="ui container">
        <a href="/" class="header item">
            <img class="logo" src="/images/logo/justice-white.png">&nbsp;Justice +
        </a>
        <a href="/problems" class="item">Problems</a>
        <a href="/submissions" class="item">Submissions</a>
        <a href="/ranking" class="item">Ranking</a>
        <a href="https://gitter.im/justice-plus/justice.plus" class="item" target="_blank">Chat</a>
        <?php
        if (Yii::$app->session->get(Yii::$app->params['userLoggedInKey'])) {
            $user_name = Yii::$app->session->get(Yii::$app->params['userNameKey']);
            $notice_html = ($notice_counter = NotificationService::getNewNoticeCounter($user_name)) === 0
                ? ''
                : '<div class="ui red circular label">' . $notice_counter . '</div>';

            echo <<< TIP
        <div class="ui right floated simple dropdown item">
            {$user_name} <i class="dropdown icon"></i>
            <div class="menu">
                <a class="item" href="/settings">
                    <i class="settings icon"></i> Settings
                </a>
                <a class="item" href="/notifications">
                    <i class="mail icon"></i> Notifications
                    {$notice_html}
                </a>
                <a class="item" href="/profile?name={$user_name}">
                    <i class="privacy icon"></i> My Profile
                </a>
                <div class="divider"></div>
                <a class="item" href="/logout">
                    <i class="sign out icon"></i> Logout
                </a>
            </div>
        </div>
TIP;
        } else {
            echo <<< TIP
            <a href="/login" class="ui right floated item">Login</a>
TIP;
        }
        ?>
    </div>
</div>
<div class="ui main container">
    <?= $content ?>
</div>
<div class="ui inverted vertical footer segment">
    <div class="ui center aligned container">
        <div class="ui stackable inverted divided grid">
            <div class="four wide column">
                <h4 class="ui inverted header">Get in touch with us</h4>
                <div class="ui inverted link list">
                    <a class="item" href="https://twitter.com/justice_OJ" target="_blank">
                        <i class="twitter icon"></i>&nbsp; Twitter
                    </a>
                    <a class="item">
                        <i class="mail icon"></i>&nbsp; aUBsaXVjaGFvLm1l
                    </a>
                </div>
            </div>
            <div class="twelve wide column">
                <h2>In solitude, be a multitude to yourself.</h2>
                <a href="https://www.vultr.com/?ref=7059603">
                    <img src="https://www.vultr.com/media/banner_1.png" width="728" height="90">
                </a>
                <div class="ui center aligned inverted">
                    <small>Handcrafted with <span style="font-size: 300%">&dzigrarr;</span> <span style="color:red; font-size: 150%">&hearts;</span></small>
                </div>
            </div>
        </div>
        <div class="ui inverted section divider"></div>
        <img src="/images/logo/justice-white.png" class="ui centered mini image">
        <div class="ui horizontal inverted small divided link list">
            <a class="item" href="/about-us">About Us</a> |
            <a href="//www.iubenda.com/privacy-policy/8235776" class="iubenda-black iubenda-embed" title="Privacy Policy">Privacy Policy</a><script type="text/javascript">(function (w,d) {var loader = function () {var s = d.createElement("script"), tag = d.getElementsByTagName("script")[0]; s.src = "//cdn.iubenda.com/iubenda.js"; tag.parentNode.insertBefore(s,tag);}; if(w.addEventListener){w.addEventListener("load", loader, false);}else if(w.attachEvent){w.attachEvent("onload", loader);}else{w.onload = loader;}})(window, document);</script>
        </div>
    </div>
</div>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>