<?php

use www\widgets\common\GoogleAdSenseWidget;

?>

<link href="<?= Yii::$app->params['staticFile']['KaTex']['css'] ?>" rel="stylesheet">
<script src="<?= Yii::$app->params['staticFile']['KaTex']['js'] ?>"></script>
<link href="<?= Yii::$app->params['staticFile']['Quill']['css'] ?>" rel="stylesheet">
<script src="<?= Yii::$app->params['staticFile']['Quill']['js'] ?>"></script>
<div class="ui basic segment">
    <?= /** @noinspection PhpUnhandledExceptionInspection */ GoogleAdSenseWidget::widget() ?>
</div>
<h2 class="ui header"><?= /** @var $problem \common\models\Problem */ $problem->title ?></h2>
<div class="ui top fluid four item menu">
    <a class="item" href="/problem?problem_id=<?= $problem->id ?>">Problem</a>
    <a class="item" href="/problem/submissions?problem_id=<?= $problem->id ?>">Submissions</a>
    <a class="item" href="/problem/discussions?problem_id=<?= $problem->id ?>">Discussions</a>
    <a class="item active">Editorial</a>
</div>
<?php
/** @var $editorial \common\models\Editorial */
if (is_null($editorial)) {
    /** @lang html */
    echo <<< NULL
<div class="ui basic center aligned segment">
  <i class="massive icons">
    <i class="file text outline icon"></i>
    <i class="bottom right corner help icon"></i>
  </i>
  <h2 class="ui header">To be done.</h2>
</div>
NULL;
} else {
    /** @lang html */
    echo <<< ARTICLE
<div class="ui basic segment" id="article"></div>
<!--suppress JSUnresolvedFunction -->
<script>
var quill = new Quill('#article', {
    modules: {
        toolbar: null
    },
    readOnly: true,
    theme: 'snow'
});
quill.setContents({$editorial->content});
</script>
ARTICLE;
}
?>

<div class="ui basic segment">
    <?= /** @noinspection PhpUnhandledExceptionInspection */ GoogleAdSenseWidget::widget() ?>
</div>
<script>
    $(document).ready(function () {
        $('.menu .item').tab();
        $('.ui.embed').embed();
    });
</script>