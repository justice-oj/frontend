<?php use yii\helpers\Html; ?>
<?php $this->beginPage() ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Justice PLUS - admin login</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" href="/favicon-32x32.png" sizes="32x32">
    <link rel="icon" type="image/png" href="/favicon-16x16.png" sizes="16x16">
    <link rel="manifest" href="/manifest.json">
    <link href="<?= Yii::$app->params['staticFile']['Bootstrap']['css'] ?>" rel="stylesheet">
    <script src="<?= Yii::$app->params['staticFile']['jQuery'] ?>"></script>
    <script src="<?= Yii::$app->params['staticFile']['Bootstrap']['js'] ?>"></script>
    <link href="<?= Yii::$app->params['staticFile']['FontAwesome'] ?>" rel="stylesheet">
    <?= Html::csrfMetaTags() ?>
    <style>
        .container {padding-top: 8%;}
        body {background-color: #c1c1c1;}
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
<div class="container">
    <?= /** @var $content string */ $content ?>
</div>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>