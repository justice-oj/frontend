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
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
    </head>
    <body>
    <div class="ui fixed inverted menu">
        <div class="ui container">
            <a href="/" class="header item">
                <img class="logo" src="/images/logo/justice-white.png">&nbsp;&nbsp;&nbsp;Justice +
            </a>
            <a href="/" class="item">Home</a>
            <a href="/problems" class="item">Problems</a>
            <a href="/submissions" class="item">Submissions</a>
            <a href="/ranking" class="item">Ranking</a>
            <div class="ui right floated simple dropdown item">
                liupangzi <i class="dropdown icon"></i>
                <div class="menu">
                    <a class="item" href="/settings">Settings</a>
                    <div class="divider"></div>
                    <a class="item" href="/profile/statistics">My Statistics</a>
                    <a class="item" href="/profile/submissions">My Submissions</a>
                    <a class="item" href="/profile/contests">My Contests</a>
                    <div class="divider"></div>
                    <a class="item" href="/logout">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <div class="ui main text container">
        <?php $this->beginBody() ?>
        <?= $content ?>
        <?php $this->endBody() ?>
    </div>

    <div class="ui inverted vertical footer segment">
        <div class="ui center aligned container">
            <div class="ui stackable inverted divided grid">
                <div class="three wide column">
                    <h4 class="ui inverted header">About Justice OJ</h4>
                    <div class="ui inverted link list">
                        <a class="item" href="https://www.justice.plus/" target="_blank">
                            <i class="keyboard icon"></i>&nbsp; Website
                        </a>
                        <a class="item" href="https://twitter.com/justice_OJ" target="_blank">
                            <i class="twitter icon"></i>&nbsp; Twitter
                        </a>
                    </div>
                </div>
                <div class="three wide column">
                    <h4 class="ui inverted header">Group 2</h4>
                    <div class="ui inverted link list">
                        <a href="#" class="item">Link One</a>
                        <a href="#" class="item">Link Two</a>
                        <a href="#" class="item">Link Three</a>
                        <a href="#" class="item">Link Four</a>
                    </div>
                </div>
                <div class="three wide column">
                    <h4 class="ui inverted header">Group 3</h4>
                    <div class="ui inverted link list">
                        <a href="#" class="item">Link One</a>
                        <a href="#" class="item">Link Two</a>
                        <a href="#" class="item">Link Three</a>
                        <a href="#" class="item">Link Four</a>
                    </div>
                </div>
                <div class="seven wide column">
                    <h4 class="ui inverted header">Footer Header</h4>
                    <p>Extra space for a call to action inside the footer that could help re-engage users.</p>
                </div>
            </div>
            <div class="ui inverted section divider"></div>
            <img src="/image/logo/justice-white.png" class="ui centered mini image">
            <div class="ui horizontal inverted small divided link list">
                <a class="item" href="#">Site Map</a>
                <a class="item" href="#">Contact Us</a>
                <a class="item" href="#">Terms and Conditions</a>
                <a class="item" href="#">Privacy Policy</a>
            </div>
        </div>
    </div>
    </body>
</html>
<?php $this->endPage() ?>