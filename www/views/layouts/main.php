<?php use yii\helpers\Html; ?>
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
    <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
    <script>
        (adsbygoogle = window.adsbygoogle || []).push({
            google_ad_client: "ca-pub-7808611005897513",
            enable_page_level_ads: true
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
        <a href="/discussions" class="item">Discussions</a>
        <a href="/ranking" class="item">Ranking</a>
        <a href="/editorials" class="item">Editorials</a>
        <?php
        if (Yii::$app->session->get(Yii::$app->params['userLoggedInKey'])) {
            $user_name = Yii::$app->session->get(Yii::$app->params['userNameKey']);
            echo <<< TIP
        <div class="ui right floated simple dropdown item">
            {$user_name} <i class="dropdown icon"></i>
            <div class="menu">
                <a class="item" href="/settings">Settings</a>
                <div class="divider"></div>
                <a class="item" href="/my/statistics">My Statistics</a>
                <a class="item" href="/my/submissions">My Submissions</a>
                <div class="divider"></div>
                <a class="item" href="/logout">Logout</a>
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
            </div>
        </div>
        <div class="ui inverted section divider"></div>
        <img src="/images/logo/justice-white.png" class="ui centered mini image">
        <div class="ui horizontal inverted small divided link list">
            <a class="item" href="#">Site Map</a>
            <a class="item" href="#">Contact Developer</a>
            <a class="item" href="#">Terms and Conditions</a>
            <a class="item" href="#">Privacy Policy</a>
        </div>
    </div>
</div>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>