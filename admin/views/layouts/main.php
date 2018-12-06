<?php use yii\helpers\Html;
use yii\helpers\Url;

?>
<?php $this->beginPage() ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
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
        <link rel="stylesheet" href="<?= Url::home(true) ?>css/violet.css" id="theme-stylesheet">
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
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
    <header class="header">
        <nav class="navbar navbar-expand-lg">
            <div class="container-fluid d-flex align-items-center justify-content-between">
                <div class="navbar-header">
                    <a href="/" class="navbar-brand">
                        <div class="brand-text brand-big visible text-uppercase">
                            <strong class="text-primary">Justice PLUS</strong>
                            <strong>Admin</strong>
                        </div>
                    </a>
                </div>
                <div class="right-menu list-inline no-margin-bottom">
                    <div class="list-inline-item logout">
                        <a id="logout" href="/logout" class="nav-link">Logout <i class="fa fa-sign-out"></i></a>
                    </div>
                </div>
            </div>
        </nav>
    </header>
    <?= /** @var string $content */
    $content ?>
    <?php $this->endBody() ?>
    </body>
    </html>
<?php $this->endPage() ?>