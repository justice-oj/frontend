<?php use yii\helpers\Html; ?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html>
<head>
    <title>Fixed Menu Example - Semantic</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" href="/favicon-32x32.png" sizes="32x32">
    <link rel="icon" type="image/png" href="/favicon-16x16.png" sizes="16x16">
    <link rel="manifest" href="/manifest.json">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <style>
        #main {padding-top: 3%}
    </style>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
</head>
<body>
<?php $this->beginBody() ?>
<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <a class="navbar-brand" href="/">Justice PLUS</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li <?= Yii::$app->controller->module->id == 'user' ? 'class="active"' : '' ?>><a href="/user">User</a></li>
                <li <?= Yii::$app->controller->module->id == 'problem' ? 'class="active"' : '' ?>><a href="/problem">Problem</a></li>
            </ul>
        </div>
    </div>
</nav>
<div class="container" id="main">
    <?= $content ?>
</div>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>