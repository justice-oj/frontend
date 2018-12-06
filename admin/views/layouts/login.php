<?php use yii\helpers\Html; ?>
<?php $this->beginPage() ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <title>Justice PLUS - admin login</title>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
        <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
        <link rel="icon" type="image/png" href="/favicon-32x32.png" sizes="32x32">
        <link rel="icon" type="image/png" href="/favicon-16x16.png" sizes="16x16">
        <link rel="manifest" href="/manifest.json">
        <link href="<?= Yii::$app->params['staticFile']['Bootstrap']['css'] ?>" rel="stylesheet">
        <script src="<?= Yii::$app->params['staticFile']['jQuery'] ?>"></script>
        <script src="<?= Yii::$app->params['staticFile']['Bootstrap']['js'] ?>"></script>
        <link href="<?= Yii::$app->params['staticFile']['FontAwesome'] ?>"
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Muli:300,400,700">
        <link rel="stylesheet" href="/css/violet.css" id="theme-stylesheet">
        <?= Html::csrfMetaTags() ?>
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
    <?= /** @var string $content */
    $content ?>
    <?php $this->endBody() ?>
    </body>
    </html>
<?php $this->endPage() ?>